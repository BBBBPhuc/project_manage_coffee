<?php

use App\Http\Controllers\API\APIBanController;
use App\Http\Controllers\API\APICaLamController;
use App\Http\Controllers\API\APIChamCongController;
use App\Http\Controllers\API\APICustomerController;
use App\Http\Controllers\API\APIHangHoaController;
use App\Http\Controllers\API\APIKhuVucController;
use App\Http\Controllers\API\APILoaiHangHoaController;
use App\Http\Controllers\API\APINhanVienController;
use App\Http\Controllers\API\APIDonViController;
use App\Http\Controllers\API\APITaiKhoanCaLamController;
use App\Http\Controllers\API\APIThuChiController;
use App\Http\Controllers\API\APIdanhsachtaikhoancontroller;
use App\Http\Controllers\API\APIPhuongThucThanhToanController;
use App\Http\Controllers\API\APIDonDatMonController;
use App\Http\Controllers\API\APIHoaDonBanHangController;
use App\Http\Controllers\API\APILenDonController;
use App\Http\Controllers\API\APITrangChuController;
use App\Http\Controllers\API\APIUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/home-page', [APITrangChuController::class, 'homeData'])->name('dataHomePage');
Route::post('/detail-page', [APITrangChuController::class, 'detailData'])->name('dataDetailPage');
Route::post('/shop-page', [APITrangChuController::class, 'shopData'])->name('dataShopPage');
Route::post('/register', [APIdanhsachtaikhoancontroller::class, 'register'])->name('register');
Route::post('/login', [APIdanhsachtaikhoancontroller::class, 'login'])->name('login');
Route::post('/admin/login', [APINhanVienController::class, 'adminlogin'])->name('adminlogin');


Route::group(['prefix' => '/client', 'middleware' => 'ApiClientMiddleware'], function () {
    Route::post('/create-don-dat', [APIDonDatMonController::class, 'store'])->name('taoDonDatMon');
    Route::post('/create-hoa-don', [APIHoaDonBanHangController::class, 'createHoaDon'])->name('taoHoaDon');
    Route::post('/data', [APIDonDatMonController::class, 'data'])->name('dataDonDatMon');
    Route::post('/xoa-don-dat-mon', [APIDonDatMonController::class, 'erase'])->name('eraseDonDatMon');
    Route::post('/data-user', [APIUserController::class, 'data'])->name('dataUser');
    Route::post('/check-user', [APIUserController::class, 'checkPass'])->name('checkUser');
    Route::post('/load-count', [APIDonDatMonController::class, 'count'])->name('countDonDatMon');
    Route::post('/load-payed', [APIHoaDonBanHangController::class, 'dataPay'])->name('dataHistoryPay');
});

Route::group(['prefix' => '/admin'], function () {
    //Loại Hàng Hóa
    Route::group(['prefix' => 'loai-hang-hoa'], function () {
        Route::post('/data', [APILoaiHangHoaController::class, 'layData'])->name('dataLoaiHangHoa');
        Route::post('/create', [APILoaiHangHoaController::class, 'store'])->name('createLoaiHangHoa');
        Route::post('/update', [APILoaiHangHoaController::class, 'update'])->name('updateLoaiHangHoa');
        Route::post('/delete', [APILoaiHangHoaController::class, 'destroy'])->name('destroyLoaiHangHoa');
        Route::post('/status', [APILoaiHangHoaController::class, 'status'])->name('statusLoaiHangHoa');
    });

    //Đơn Vị
    Route::group(['prefix' => 'don-vi'], function () {
        Route::post('/data', [APIDonViController::class, 'layData'])->name('dataDonVi');
        Route::post('/create', [APIDonViController::class, 'store'])->name('createDonVi');
        Route::post('/update', [APIDonViController::class, 'update'])->name('updateDonVi');
        Route::post('/delete', [APIDonViController::class, 'destroy'])->name('deleteDonVi');
        Route::post('/status', [APIDonViController::class, 'status'])->name('statusDonVi');
    });

    //Hàng Hóa
    Route::group(['prefix' => 'hang-hoa'], function () {
        Route::post('/finding', [APIHangHoaController::class, 'search'])->name('searchHangHoa');
        Route::post('/data', [APIHangHoaController::class, 'layData'])->name('dataHangHoa');
        Route::post('/create', [APIHangHoaController::class, 'store'])->name('createHangHoa');
        Route::post('/update', [APIHangHoaController::class, 'update'])->name('updateHangHoa');
        Route::post('/delete', [APIHangHoaController::class, 'destroy'])->name('deleteHangHoa');
        Route::post('/status', [APIHangHoaController::class, 'status'])->name('statusHangHoa');
    });

    //Khu Vực
    Route::group(['prefix' => 'khu-vuc'], function () {
        Route::post('/data', [APIKhuVucController::class, 'layData']);
        Route::post('/create', [APIKhuVucController::class, 'store']);
        Route::post('/update', [APIKhuVucController::class, 'update']);
        Route::post('/delete', [APIKhuVucController::class, 'destroy']);
        Route::post('/status', [APIKhuVucController::class, 'status']);
    });

    //Bàn
    Route::group(['prefix' => 'ban'], function () {
        Route::post('/data', [APIBanController::class, 'layData']);
        Route::post('/update', [APIBanController::class, 'update']);
        Route::post('/delete', [APIBanController::class, 'destroy']);
    });

    //Nhân viên
    Route::group(['prefix' => 'nhan-vien'], function () {
        Route::post('/data', [APINhanVienController::class, 'layData'])->name('dataNhanVien');
        Route::post('/create', [APINhanVienController::class, 'store']);
        Route::post('/update', [APINhanVienController::class, 'update']);
        Route::post('/delete', [APINhanVienController::class, 'delete']);
        Route::post('/status', [APINhanVienController::class, 'status']);
    });

    //ca làm
    Route::group(['prefix' => 'ca-lam'], function () {
        Route::post('/data', [APICaLamController::class, 'layData'])->name('dataCaLam');
        Route::post('/create', [APICaLamController::class, 'store'])->name('themCaLam');
        Route::post('/update', [APICaLamController::class, 'update'])->name('updateCaLam');
        Route::post('/status', [APICaLamController::class, 'status'])->name('statusCaLam');
        Route::post('/delete', [APICaLamController::class, 'destroy'])->name('xoaCaLam');
    });

    //Thu Chi
    Route::group(['prefix' => 'thu-chi'], function () {
        Route::post('/data', [APIThuChiController::class, 'layData']);
        Route::post('/create', [APIThuChiController::class, 'store']);
        Route::post('/update', [APIThuChiController::class, 'update']);
        Route::post('/status', [APIThuChiController::class, 'status']);
        Route::post('/delete', [APIThuChiController::class, 'destroy']);
    });
    // danh sách tài khoản
    Route::group(['prefix' => 'tai_khoan'], function () {
        Route::post('/data', [APIdanhsachtaikhoancontroller::class, 'layData'])->name('datataikhoan');
        Route::post('/create', [APIdanhsachtaikhoancontroller::class, 'store'])->name('create');
        Route::post('/update', [APIdanhsachtaikhoancontroller::class, 'update'])->name('capnhat');
        Route::post('/status', [APIdanhsachtaikhoancontroller::class, 'status'])->name('doitrangthai');
        Route::post('/delete', [APIdanhsachtaikhoancontroller::class, 'destroy'])->name('xoabo');
        Route::post('/timkiem', [APIdanhsachtaikhoancontroller::class, 'timkiem'])->name('search');
        Route::post('/timkiem-sdt', [APIdanhsachtaikhoancontroller::class, 'timkiensdt'])->name('searchSDT');
    });

    //Hóa đơn bán hàng
    Route::group(['prefix' => '/hoa-don-ban-hang'], function () {
        Route::post('/data', [APIHoaDonBanHangController::class, 'data'])->name('dataHoaDon');
        Route::post('/create', [APIHoaDonBanHangController::class, 'store'])->name('creatHoaDon');
        Route::post('/update', [APIHoaDonBanHangController::class, 'update'])->name('updateHoaDon');
        Route::post('/delete', [APIHoaDonBanHangController::class, 'destroy'])->name('xoaHoaDon');
    });

    //đơn Đặt món
    Route::group(['prefix' => '/don-dat-mon'], function () {
        Route::post('/update', [APIDonDatMonController::class, 'update'])->name('updateDonDatMon');
        Route::post('/delete', [APIDonDatMonController::class, 'destroy'])->name('xoaDonDatMon');
    });

    Route::group(['prefix' => '/len-don'], function () {
        Route::post('/create', [APILenDonController::class, 'createGrubOff'])->name('createLenDon');
        Route::post('/data', [APILenDonController::class, 'data'])->name('dataLenDon');
        Route::post('/delete', [APILenDonController::class, 'destroy'])->name('xoaLenDon');
        Route::post('/delete-all', [APILenDonController::class, 'destroyAll'])->name('xoaAllLenDon');

    });

    //phương thức thanh toán
    Route::group(['prefix' => '/phuong-thuc-thanh-toan'], function () {
        Route::post('/get-data', [APIPhuongThucThanhToanController::class, 'layData'])->name('dataPhuongThuc');
        Route::post('/create', [APIPhuongThucThanhToanController::class, 'store'])->name('createPhuongThuc');
        Route::post('/status', [APIPhuongThucThanhToanController::class, 'status'])->name('statusPhuongThuc');
        Route::post('/delete', [APIPhuongThucThanhToanController::class, 'destroy'])->name('destroyPhuongThuc');
    });

});
