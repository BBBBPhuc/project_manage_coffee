<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\danhsachtaikhoan;
use App\Models\DonDatMon;
use App\Models\HangHoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APILenDonController extends Controller
{
    public function data() {
        $user = Auth::guard('admin')->user();

        $dataHangHoa = HangHoa::where('tinh_trang', 1)
                               ->get();
        $donDat = DonDatMon::where('id_nhan_vien', $user->id)
                            ->where('ma_hoa_don', null)
                            ->get();

        $listSDT = danhsachtaikhoan::where('tinh_trang', 1)
                                   ->select('so_dien_thoai')
                                   ->get();
        $arr = [];
        foreach ($donDat as $key => $value) {
            $dataGrub = HangHoa::find($value->id_hang_hoa);
            if ($dataGrub) {
                $dataGrub['so_luong'] = $value->so_luong;
                $dataGrub['id_don_dat'] = $value->id;
            }
            array_push($arr, $dataGrub);
        }
        return response()->json([
            'dataHangHoa' => $dataHangHoa,
            'dataGrub' => $arr,
            'listSDT'  => $listSDT
        ]);


    }

    public function createGrubOff(Request $request) {
        $user = Auth::guard('admin')->user();
        $donDat = DonDatMon::create([
            'id_hang_hoa' => $request->id,
            'so_luong' => $request->so_luong
        ]);
        $donDat->id_nhan_vien = $user->id;
        $donDat->save();

        return response()->json([
            'status'    => 1,
            'message'   => 'Thêm sản phẩm thành công',
        ]);
    }

    public function destroyAll(Request $request) {
        $user = Auth::guard('admin')->user();
        $data = $request->all();
        if ($data) {
            foreach ($data as $key => $value) {
                DonDatMon::where('id_nhan_vien', $user->id)
                         ->where('id', $value['id_don_dat'])
                         ->delete();
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Xóa Đơn Đặt Hàng Thành Công',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không Tìm Thấy Đơn Hàng',
            ]);
        }
    }


    public function destroy(Request $request) {
        $user = Auth::guard('admin')->user();
        DonDatMon::where('id_nhan_vien', $user->id)
                            ->where('id', $request->id)
                            ->delete();
            return response()->json([
                'status'    => 1,
                'message'   => 'Xóa món hàng thành công',
            ]);
    }
}
