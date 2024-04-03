<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KhuVucController extends Controller
{
    public function viewKhuVuc() {
        return view('admin.pages.khu_vuc.index');
    }
}
