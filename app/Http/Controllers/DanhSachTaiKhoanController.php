<?php

namespace App\Http\Controllers;

use App\Models\danhsachtaikhoan;
use Illuminate\Http\Request;

class DanhSachTaiKhoanController extends Controller
{
    public function viewtaikhoan(){
        return view('admin.pages.danh_sach_tai_khoan.index');
    }


}
