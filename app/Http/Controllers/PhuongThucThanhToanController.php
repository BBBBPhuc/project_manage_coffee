<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhuongThucThanhToanController extends Controller
{
    public function viewPhuongThucThanhToan()
    {
        return view('admin.pages.phuong_thuc_thanh_toan.index');
    }
}
