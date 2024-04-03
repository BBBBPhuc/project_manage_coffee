<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaLamController extends Controller
{
    public function viewCaLam()
    {
        return view('admin.pages.ca_lam.index');
    }
}
