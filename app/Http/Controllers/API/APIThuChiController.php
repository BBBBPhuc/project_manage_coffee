<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ThuChi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIThuChiController extends Controller
{
    public function layData(Request $request)
    {
        $data = ThuChi::get();
        return response()->json([
            'data'   => $data,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();

            ThuChi::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm mới khoản thu chi!',
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
            $thu_chi = ThuChi::find($request->id);
            if($thu_chi){
                $abc = $request->all();
                $thu_chi->update($abc);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật khoản thu chi!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'khoản thu chi không tồn tại!',
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
            $thu_chi = ThuChi::find($request->id);
            if($thu_chi){
                $thu_chi->tinh_trang = !$thu_chi->tinh_trang;
                $thu_chi->save();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái khoản thu chi!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'khoản thu chi không tồn tại!',
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
            $thu_chi = ThuChi::find($request->id);
            if($thu_chi){
                $thu_chi->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa khoản thu chi!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'khoản thu chi không tồn tại!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
