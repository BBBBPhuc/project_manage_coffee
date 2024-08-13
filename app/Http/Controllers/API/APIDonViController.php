<?php

namespace App\Http\Controllers\API;

use App\Models\DonVi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class APIDonViController extends Controller
{
    public function layData(Request $request)
    {
        $data = DonVi::get();
        return response()->json([
            'data'   => $data,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            DonVi::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm Đơn Vị mới!',
            ]);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $donVi = DonVi::find($request->id);
            if ($donVi) {
                $data = $request->all();
                $donVi->update($data);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Đơn Vị',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Cập nhật thất bại, Kiểm tra lại Đơn Vị!',
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
            $donVi = DonVi::find($request->id);
            if ($donVi) {

                $donVi['deleted'] = 1;
                $donVi->save();
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Đơn Vị!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Thất bại, Kiểm tra lại Đơn Vị!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function status(Request $request)
    {
        DB::beginTransaction();

        try {
            $don_vi = DonVi::find($request->id);
            if ($don_vi) {
                $don_vi->tinh_trang = !$don_vi->tinh_trang;
                $don_vi->save();
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại Đơn Vị!',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
