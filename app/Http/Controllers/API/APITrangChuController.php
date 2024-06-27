<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HangHoa;
use App\Models\LoaiHangHoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APITrangChuController extends Controller
{
    public function homeData() {
        $types = LoaiHangHoa::where('loai_hang_hoas.tinh_trang', 1)
                             ->join('hang_hoas', 'hang_hoas.id_loai_hang_hoa', 'loai_hang_hoas.id')
                             ->select('loai_hang_hoas.ten_loai_hang', 'loai_hang_hoas.id', DB::raw('count(hang_hoas.id) as so_luong'),
                             'loai_hang_hoas.hinh_anh')
                             ->groupBy('loai_hang_hoas.ten_loai_hang', 'loai_hang_hoas.id', 'loai_hang_hoas.hinh_anh')
                             ->get();
        $items = HangHoa::where('tinh_trang', 1)
                                ->get();
        return response()->json([
            'items' => $items,
            'types' => $types
       ]);
    }

    public function detailData(Request $request) {
        $data = HangHoa::find($request->id);
        if ($data) {
            $dataSame = HangHoa::where('id_loai_hang_hoa', $data->id_loai_hang_hoa)
                                ->take(4)
                                ->get();
            return response()->json([
                'data'    => $data,
                'dataSame'   => $dataSame,
            ]);
        }
    }

    public function shopData() {
        $types = LoaiHangHoa::where('loai_hang_hoas.tinh_trang', 1)
                            ->join('hang_hoas', 'hang_hoas.id_loai_hang_hoa', 'loai_hang_hoas.id')
                            ->select('loai_hang_hoas.ten_loai_hang', 'loai_hang_hoas.id', DB::raw('count(hang_hoas.id) as so_luong'))
                            ->groupBy('loai_hang_hoas.ten_loai_hang', 'loai_hang_hoas.id')
                            ->get();

        $items = HangHoa::where('tinh_trang', 1)
                ->get();

        return response()->json([
            'items' => $items,
            'types' => $types
        ]);
    }
}
