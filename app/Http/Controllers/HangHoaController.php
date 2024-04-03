<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HangHoaController extends Controller
{
    public function viewHangHoa()
    {
        return view('admin.pages.hang_hoa.index');
    }
}
