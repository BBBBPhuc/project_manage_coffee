<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function viewDonVi() {
        return view('admin.pages.don_vi.index');
   }
}
