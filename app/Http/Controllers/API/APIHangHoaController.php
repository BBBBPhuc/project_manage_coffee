<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DonVi;
use App\Models\HangHoa;
use App\Models\LoaiHangHoa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIHangHoaController extends Controller
{
    public function search(Request $request)
    {
        $data = HangHoa::where('ten_hang_hoa', 'LIKE', '%' .  $request->tt . '%')
                        ->orwhere('gia_hang_hoa', 'LIKE', '%' . $request->tt . '%')
                        ->orwhere('mo_ta', 'LIKE', '%' . $request->tt . '%')
                        ->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function layData(Request $request)
    {
        $data = HangHoa::join('loai_hang_hoas', 'hang_hoas.id_loai_hang_hoa', 'loai_hang_hoas.id')
                        ->join('don_vis', 'hang_hoas.id_don_vi', 'don_vis.id')
                        ->select('hang_hoas.*', 'loai_hang_hoas.ten_loai_hang', 'don_vis.ten_don_vi')
                        ->get();
        $don_vi = DonVi::get();
        $loai_hang_hoa = LoaiHangHoa::get();

        return response()->json([
            'data'   => $data,
            'don_vi' => $don_vi,
            'loai_hang_hoa' => $loai_hang_hoa,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            HangHoa::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm Hàng Hóa mới!',
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
            $HangHoa = HangHoa::find($request->id);
            if($HangHoa){
                $data = $request->all();
                $HangHoa->update($data);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Hàng Hóa',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Cập nhật thất bại, Kiểm tra lại Hàng Hóa!',
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
            $HangHoa = HangHoa::find($request->id);
            if($HangHoa){
                $HangHoa->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Hàng Hóa!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Thất bại, Kiểm tra lại Hàng Hóa!',
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
            $hang_hoa = HangHoa::find($request->id);
            if($hang_hoa){
                $loai =  LoaiHangHoa::find($hang_hoa->id_loai_hang_hoa);
                if ($loai && $loai->tinh_trang == 0) {
                    return response()->json([
                        'status'    => 0,
                        'message'   => 'Loại Hàng Hóa Đã Tạm Tắt!',
                    ]);
                }
                $hang_hoa->tinh_trang = !$hang_hoa->tinh_trang;
                $hang_hoa->save();
                DB::commit();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại Hàng Hóa!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
