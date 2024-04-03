<?php

namespace App\Http\Controllers;

use App\Models\DonDatMon;
use App\Models\HangHoa;
use App\Models\LoaiHangHoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrangChuController extends Controller
{
   public function home() {
    $data_types = LoaiHangHoa::where('loai_hang_hoas.tinh_trang', 1)
                             ->join('hang_hoas', 'hang_hoas.id_loai_hang_hoa', 'loai_hang_hoas.id')
                             ->select('loai_hang_hoas.ten_loai_hang', 'loai_hang_hoas.id', DB::raw('count(hang_hoas.id) as so_luong'))
                             ->groupBy('loai_hang_hoas.ten_loai_hang', 'loai_hang_hoas.id')
                             ->get();

    $data_products = HangHoa::where('tinh_trang', 1)
                            ->get();
        return view('client.pages.homePage', compact('data_products', 'data_types'));
   }

   public function detail() {
        return view('client.pages.detail');
   }

   public function order() {
        return view('client.pages.order');
   }

   public function test() {
       return view('admin.pages.mail.mail_thanh_toan');
   }

   public function listPayed() {
        return view('client.pages.listPayed');
   }

   public function viewShop() {
        return view('client.pages.shop');
   }

   public function viewTrangChu() {
        return view('admin.pages.trang_chu.index');
   }
}
