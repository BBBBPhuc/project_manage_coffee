<?php

use App\Http\Controllers\CaLamController;
use App\Http\Controllers\ChamCongController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\HangHoaController;
use App\Http\Controllers\DonViController;
use App\Http\Controllers\KhuVucController;
use App\Http\Controllers\LoaiHangHoaController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhuongThucThanhToanController;
use App\Http\Controllers\DanhSachTaiKhoanController;
use App\Http\Controllers\DonDatMonController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\UserController;
use App\Models\danhsachtaikhoan;
use App\Models\HoaDonBanHang;
use Illuminate\Support\Facades\Route;


Route::get('/', [TrangChuController::class, 'home']);
Route::get('/test', [TrangChuController::class, 'test']);
Route::get('/detail/{id}', [TrangChuController::class, 'detail']);
Route::get('/login&register', [CustomController::class, 'viewLogin']);
// Route::get('/kich-hoat-tai-khoan/{id}', [CustomController::class, 'kichhoat']);
Route::get('/forgot-password', [CustomController::class, 'forgotPass']);
Route::get('/shop', [TrangChuController::class, 'viewShop']);

Route::group(['prefix' => '/', 'middleware' => 'WebClientMiddleware'], function() {
    Route::get('/logout', [CustomController::class, 'logout']);
    Route::get('/order', [TrangChuController::class, 'order']);
    Route::get('/list-Payed', [TrangChuController::class, 'listPayed']);
    Route::get('/tai-khoan-ca-nhan', [UserController::class, 'user']);
});

Route::get('/admin/login', [NhanVienController::class, 'viewLogin']);


Route::group(['prefix' => '/admin', 'middleware' => 'WebAdminMiddleware'], function () {
    Route::group(['prefix' => '/trang-chu'], function () {
        Route::get('/', [TrangChuController::class, 'viewTrangChu']);
    });
    Route::group(['prefix' => '/loai-hang-hoa'], function () {
        Route::get('/', [LoaiHangHoaController::class, 'viewLoaiHangHoa']);
    });
    Route::group(['prefix' => '/hang-hoa'], function () {
        Route::get('/', [HangHoaController::class, 'viewHangHoa']);
    });
    Route::group(['prefix' => '/don-vi'], function () {
        Route::get('/', [DonViController::class, 'viewDonVi']);
    });
    Route::group(['prefix' => '/ca-lam'], function () {
        Route::get('/', [CaLamController::class, 'viewCaLam']);
    });
    Route::group(['prefix' => '/khu-vuc'], function () {
        Route::get('/', [KhuVucController::class, 'viewKhuVuc']);
    });
    Route::group(['prefix' => '/hoa-don'], function () {
        Route::get('/', [HoaDonController::class, 'viewHoaDon']);
    });
    Route::group(['prefix' => '/nhan-vien'], function () {
        Route::get('/', [NhanVienController::class, 'viewNhanVien']);
    });
    Route::group(['prefix' => '/danh-sach-tai-khoan'], function () {
        Route::get('/', [DanhSachTaiKhoanController::class, 'viewtaikhoan']);
    });
    Route::group(['prefix' => '/phuong-thuc-thanh-toan'], function() {
        Route::get('/', [PhuongThucThanhToanController::class, 'viewPhuongThucThanhToan']);
    });
    Route::group(['prefix' => '/don-dat-mon'], function() {
        Route::get('/', [DonDatMonController::class, 'viewDatMon']);
    });
});
