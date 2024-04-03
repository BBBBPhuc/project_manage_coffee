<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PhuongThucThanhToan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIPhuongThucThanhToanController extends Controller
{
    public function layData()
    {
        $data = PhuongThucThanhToan::all();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            PhuongThucThanhToan::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm mới Phương Thức Thanh Toán!',
            ]);
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function status(Request $request)
    {
        DB::beginTransaction();

        try {
            $phuong_thuc = PhuongThucThanhToan::find($request->id);
            if($phuong_thuc){
                $phuong_thuc->tinh_trang = !$phuong_thuc->tinh_trang;
                $phuong_thuc->save();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã thay đổi tình trạng!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'PTTT không tồn tại!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $phuong_thuc = PhuongThucThanhToan::find($request->id);
            if($phuong_thuc){
                $phuong_thuc->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa PTTT!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'PTTT không tồn tại',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
