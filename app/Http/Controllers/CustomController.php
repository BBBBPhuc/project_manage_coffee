<?php

namespace App\Http\Controllers;

use App\Models\danhsachtaikhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomController extends Controller
{
    public function viewLogin() {
        return view('client.pages.register&login');
    }

    public function kichhoat($id) {
        $check = danhsachtaikhoan::where('thay_the_id', $id)->first();
        if ($check) {
            $check->tinh_trang = 1;
            $check->thay_the_id = null;
            $check->save();
            toastr()->success('Kích hoạt tài khoản thành công');
            return redirect('/login&register');
        } else {
            toastr()->error('Tài khoản không tồn tại');
            return redirect('/login&register');
        }
    }

    public function forgotPass() {
        return view('client.pages.forgotPass');
    }

    public function logout() {
        Auth::guard('client')->logout();
        toastr()->success('Đã Đăng Xuất Thành Công');
        return redirect('/login&register');
    }
}
