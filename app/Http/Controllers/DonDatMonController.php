<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonDatMonController extends Controller
{
    public function viewDatMon() {
        return view('admin.pages.don_dat.index');
    }
}
