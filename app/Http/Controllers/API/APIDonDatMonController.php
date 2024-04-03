<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DonDatMon;
use App\Models\HangHoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIDonDatMonController extends Controller
{
    public function store(Request $request)
    {
            $user = Auth::guard('client')->user();
            $hanghoa = HangHoa::where('id', $request->id)->first();
            if ($hanghoa) {
                $dondat = DonDatMon::create([
                    'id_khach_hang' => $user->id,
                    'id_hang_hoa'   => $hanghoa->id,
                    'so_luong'      => $request->so_luong
                ]);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Thêm vào giỏ hàng thành công',
                ]);
            }
            return response()->json([
                'status'    => 0,
                'message'   => 'Thêm vào giỏ hàng thất bại',
            ]);
    }

    public function data()
    {
        $check = Auth::guard('client')->check();
        if ($check) {
            $user = Auth::guard('client')->user();
            $donDat = DonDatMon::where('id_khach_hang', $user->id)
                ->where('ma_hoa_don', null)
                ->join('hang_hoas', 'don_dat_mons.id_hang_hoa', 'hang_hoas.id')
                ->select('hang_hoas.hinh_anh', 'hang_hoas.gia_hang_hoa', 'hang_hoas.ten_hang_hoa', DB::raw('sum(don_dat_mons.so_luong) as so_luong'), 'hang_hoas.id')
                ->groupBy('hang_hoas.hinh_anh', 'hang_hoas.gia_hang_hoa', 'hang_hoas.ten_hang_hoa', 'hang_hoas.id')
                ->get();

            return response()->json([
                'data' => $donDat
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Chức Năng Này Yêu Cầu Đăng Nhập',
            ]);
        }
    }

    public function erase(Request $request)
    {
        $user = Auth::guard('client')->user();
        DonDatMon::where('id_khach_hang', $user->id)
                            ->where('id_hang_hoa', $request->id)
                            ->delete();
            return response()->json([
                'status'    => 1,
                'message'   => 'Xóa món hàng thành công',
            ]);
    }

    public function count(){
        $user = Auth::guard('client')->user();
        $count = DonDatMon::where('id_khach_hang', $user->id)
                          ->where('ma_hoa_don', null)
                          ->select(DB::raw('count(id_hang_hoa) as so_luong'))
                          ->first();

        return response()->json([
            'data' => $count
        ]);
    }

}
