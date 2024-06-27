<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DanhSachTaiKhoanController;
use App\Models\danhsachtaikhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIUserController extends Controller
{
    public function data()
    {
        $user = Auth::guard('client')->user();
        return response()->json([
            'dataUser' => $user,
        ]);
    }

    public function checkPass(Request $request)
    {
        $user = Auth::guard('client')->user();
        $check = Auth::guard('client')->attempt(['email' => $user->email, 'password' => $request->pass]);
        if ($check) {
            $dataUser = danhsachtaikhoan::find($user->id);
            if ($dataUser) {
                $data = $request->all();
                if ($data['password'] == '') {
                    unset($data['password']);
                    $dataUser->update($data);
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Lưu Thay Đổi Thành Công',
                    ]);
                } else {
                    $data['password'] = bcrypt($request->password);
                    $dataUser->update($data);
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Lưu Thay Đổi Thành Công',
                    ]);
                }
            }
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Nhập Sai Mật Khẩu',
            ]);
        }
    }
}
