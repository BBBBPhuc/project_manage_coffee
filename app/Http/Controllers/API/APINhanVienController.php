<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CaLam;
use App\Models\CaLamVsNhanVien;
use App\Models\NhanVien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APINhanVienController extends Controller
{
    public function layData(Request $request)
    {
        // Mảng lồng mảng
        $data = NhanVien::get();
        foreach ($data as $key => $value) {
            $arr = [];
            $chucVu = 0;
            $caLamNV = CaLamVsNhanVien::where('id_nhan_vien', $value->id)->get();
            foreach ($caLamNV as $key2 => $value2) {
                $dataCaLam = CaLam::find($value2->id_ca_lam);
                if ($dataCaLam) {
                    array_push($arr, $dataCaLam);
                }
            }
            $data[$key]['ds'] = $arr;
        }

        $dataCaLam = CaLam::get();

        return response()->json([
            'data'   => $data,
            'dataCaLam' => $dataCaLam
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->dataNew;
            $data['password'] = bcrypt($request->dataNew['password']);
            $user =  NhanVien::create($data);
            $dataCalam = $request->dataCaLam;

            foreach ($dataCalam as $key => $value) {
                if (isset($value['check']) && $value['check'] == true) {
                    CaLamVsNhanVien::create([
                        'id_nhan_vien' => $user->id,
                        'id_ca_lam' => $value['id'],
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm mới Nhân Viên!',
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
            $nhan_vien =NhanVien::find($request->id);
            if($nhan_vien){
                $data = $request->all();
                $nhan_vien->update($data);

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Nhân Viên',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Cập nhật thất bại, Kiểm tra lại Nhân Viên!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        try {
            $nhan_vien =NhanVien::find($request->id);
            if($nhan_vien){
                $nhan_vien->delete();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Nhân Viên!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Thất bại, Kiểm tra lại Nhân Viên!',
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
            $nhan_vien = NhanVien::find($request->id);
            if($nhan_vien){
                $nhan_vien->tinh_trang = !$nhan_vien->tinh_trang;
                $nhan_vien->save();

                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại Nhân Viên!',
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    public function adminlogin(Request $request) {
        $check  = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($check) {
            return response()->json([
                'status'    => 1,
                'message'   => 'Đăng Nhập Thành Công',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Đăng Nhập Thất Bại',
            ]);
        }


    }
}
