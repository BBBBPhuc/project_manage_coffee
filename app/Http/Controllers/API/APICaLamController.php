<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaLam;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APICaLamController extends Controller
{
    public function layData(Request $request)
    {
        $data = CaLam::get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['tinh_trang'] = 0;

            CaLam::create($data);

            DB::commit();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm mới tài khoản ca làm!',
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
            $tai_khoan_ca_lam = CaLam::find($request->id);
            if($tai_khoan_ca_lam){
                $abc = $request->all();
                $tai_khoan_ca_lam->update($abc);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật tài khoản ca làm!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản ca làm không tồn tại!',
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
            $tai_khoan_ca_lam = CaLam::find($request->id);
            if($tai_khoan_ca_lam){
                $tai_khoan_ca_lam->tinh_trang = !$tai_khoan_ca_lam->tinh_trang;
                $tai_khoan_ca_lam->save();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái tài khoản ca làm!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản ca làm không tồn tại!',
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
            $tai_khoan_ca_lam = CaLam::find($request->id);
            if($tai_khoan_ca_lam){
                $tai_khoan_ca_lam->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa tài khoản ca làm!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản ca làm không tồn tại!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
