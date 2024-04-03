<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    public function viewNhanVien() {
        return view('admin.pages.nhan_vien.index');
    }

    public function viewLogin() {
        return view('admin.pages.dang_nhap.index');
    }
}
