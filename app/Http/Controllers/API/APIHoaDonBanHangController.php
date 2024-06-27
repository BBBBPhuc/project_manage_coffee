<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Models\danhsachtaikhoan;
use App\Models\DonDatMon;
use App\Models\HangHoa;
use App\Models\HoaDonBanHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIHoaDonBanHangController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($user) {
            $hoaDon = HoaDonBanHang::create([]);
            $hoaDon->id_nhan_vien = $user->id;
            $hoaDon->ma_hoa_don = 123456 + $hoaDon->id;
            $hoaDon->save();
            $tongTien = 0;
            $listGrub = $request->all()[0];
            foreach ($listGrub as $key => $value) {
                $hangHoa = DonDatMon::where('don_dat_mons.id', $value['id_don_dat'])
                    ->join('hang_hoas', 'don_dat_mons.id_hang_hoa', 'hang_hoas.id')
                    ->select('hang_hoas.*')
                    ->first();
                if ($hangHoa) {
                    $tongTien += $hangHoa->gia_hang_hoa * $value['so_luong'];
                }
                $updateGrub = DonDatMon::find($value['id_don_dat']);
                if ($updateGrub) {
                    $updateGrub->so_luong = $value['so_luong'];
                    $updateGrub->save();
                }
            }
            $hoaDon->tong_tien = $tongTien;
            if ($request->all()[0] == 0) {
                $hoaDon->is_thanh_toan = 1;
            } else {
                $hoaDon->is_thanh_toan = 0;
            }
            $hoaDon->save();
            $number = $request->all()[2];
            if ($number != "") {
                $client = danhsachtaikhoan::where('so_dien_thoai', $number)
                    ->first();
                if ($client) {
                    $tongTien = $tongTien / 1000;
                    $client->score_order = $tongTien;
                    $client->save();
                }
            }
            foreach ($listGrub as $key => $value) {
                $donDat = DonDatMon::find($value['id_don_dat']);
                if ($donDat) {
                    $donDat->ma_hoa_don = $hoaDon->ma_hoa_don;
                    $donDat->save();
                }
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo Hóa Đơn Thành Công',
                'ma_hoa_don' => $hoaDon->ma_hoa_don
            ]);
        }
    }

    public function data()
    {
        $data = HoaDonBanHang::get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $hoaDon = HoaDonBanHang::find($request->id);
            if ($hoaDon) {
                $data = $request->all();
                $hoaDon->update($data);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Hóa Đơn!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Hóa Đơn không tồn tại!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $hoaDon = HoaDonBanHang::find($request->id);
            if ($hoaDon) {
                $hoaDon->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Hóa Đơn!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Hóa Đơn không tồn tại!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function createHoaDon(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::guard('client')->user();
            if ($user) {
                $hoaDon = HoaDonBanHang::create([]);
                $hoaDon->nguoi_tao_hoa_don = $user->id;
                $hoaDon->ma_hoa_don = 345396 + $hoaDon->id;
                $hoaDon->save();
                $tong_tien = 0;
                $dataClient = $request->all();
                $arr = [];
                foreach ($dataClient as $key => $value) {
                    $dataHangHoa = HangHoa::where('id', $value['id'])->first();
                    if ($dataHangHoa) {
                        $tong_tien = $tong_tien + ($dataHangHoa->gia_hang_hoa * $value['so_luong']);
                        $dataHangHoa['so_luong'] = $value['so_luong'];
                        $dataHangHoa['thanh_tien'] = $value['so_luong'] * $dataHangHoa->gia_hang_hoa;
                        array_push($arr, $dataHangHoa);
                    }
                }
                $hoaDon->phuong_thuc_thanh_toan = 1;
                $hoaDon->tong_tien = $tong_tien;
                $hoaDon->is_thanh_toan = 0;
                $hoaDon->save();

                $donDat = DonDatMon::where('ma_hoa_don', null)
                    ->get();

                foreach ($donDat as $key => $value) {
                    $value->ma_hoa_don = $hoaDon->ma_hoa_don;
                    $value->save();
                }

                DB::commit();

                // $data['ds_hang'] = $arr;
                // $data['ho_va_ten'] = $user->ho_va_ten;
                // $data['tong_tien'] = $tong_tien;
                // $data['ma_hoa_don'] = $hoaDon->ma_hoa_don;

                // SendMailJob::dispatch($user->email, 'Thông Tin Thanh Toán', 'admin.pages.mail.mail_thanh_toan', $data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Chúng tôi đã nhận thành công đơn hàng của bạn',
                    'codeOrder' => $hoaDon
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
    public function dataPay()
    {
        $user = Auth::guard('client')->user();

        if ($user) {
            $hoaDon = HoaDonBanHang::where('nguoi_tao_hoa_don', $user->id)
                ->join('don_dat_mons', 'hoa_don_ban_hangs.ma_hoa_don', 'don_dat_mons.ma_hoa_don')
                ->join('hang_hoas', 'don_dat_mons.id_hang_hoa', 'hang_hoas.id')
                ->select(
                    'hang_hoas.ten_hang_hoa',
                    'hang_hoas.gia_hang_hoa',
                    'hang_hoas.hinh_anh',
                    'don_dat_mons.so_luong',
                    'hoa_don_ban_hangs.created_at',
                    'hoa_don_ban_hangs.is_thanh_toan',
                    'hoa_don_ban_hangs.ma_hoa_don',
                    'hoa_don_ban_hangs.tong_tien'
                )
                ->groupBy(
                    'hang_hoas.ten_hang_hoa',
                    'hang_hoas.gia_hang_hoa',
                    'hang_hoas.hinh_anh',
                    'don_dat_mons.so_luong',
                    'hoa_don_ban_hangs.created_at',
                    'hoa_don_ban_hangs.is_thanh_toan',
                    'hoa_don_ban_hangs.ma_hoa_don',
                    'hoa_don_ban_hangs.tong_tien'
                )
                ->get();

            // dd($hoaDon->toArray());


            return response()->json([
                'data' => $hoaDon
            ]);
        }
    }
}
