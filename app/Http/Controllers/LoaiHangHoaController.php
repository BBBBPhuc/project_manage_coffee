<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoaiHangHoaController extends Controller
{
    public function viewLoaiHangHoa() {
        return view('admin.pages.loai_hang_hoa.index');
   }
}
