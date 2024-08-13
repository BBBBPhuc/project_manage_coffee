<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BanController extends Controller
{
    public function viewBan() {
        return view('admin.pages.ban.index');
    }
}
