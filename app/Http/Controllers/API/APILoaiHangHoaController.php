<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HangHoa;
use App\Models\LoaiHangHoa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APILoaiHangHoaController extends Controller
{
    public function layData(Request $request)
    {
        $data = LoaiHangHoa::get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            LoaiHangHoa::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm Loại Hàng mới!',
            ]);
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $loaiHang = LoaiHangHoa::find($request->id);
            if($loaiHang){
                $data = $request->all();
                $loaiHang->update($data);
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Loại Hàng',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Cập nhật thất bại, Kiểm tra lại Loại Hàng!',
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
            $loaiHang = LoaiHangHoa::find($request->id);
            if($loaiHang){
                $loaiHang->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Loại Hàng!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Thất bại, Kiểm tra lại Loại Hàng!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function status(Request $request)
    {
        DB::beginTransaction();

        try {
            $loai_hang_hoa = LoaiHangHoa::find($request->id);
            if($loai_hang_hoa){
                $loai_hang_hoa->tinh_trang = !$loai_hang_hoa->tinh_trang;
                $loai_hang_hoa->save();
                $dataHangHoa =  HangHoa::where('id_loai_hang_hoa',$request->id)
                                       ->get();
                foreach ($dataHangHoa as $key => $value) {
                    if ($value->tinh_trang) {
                        $value->tinh_trang = $loai_hang_hoa->tinh_trang;
                        $value->save();
                    } else {
                        $value->tinh_trang = $loai_hang_hoa->tinh_trang;
                        $value->save();
                    }
                }
                DB::commit();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại Loại Hàng này!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
