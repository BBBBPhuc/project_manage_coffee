<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use App\Models\danhsachtaikhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;



class APIdanhsachtaikhoancontroller extends Controller
{
    public function layData(Request $request){
            $data = danhsachtaikhoan::get();
            return response()->json([
                'data'   => $data,
            ]);
    }
    public function store(Request $request){
        $data = $request->all();

        danhsachtaikhoan::create($data);


        return response()->json([
            'status'    => 1,
            'message'   => 'Đã thêm mới tài khoản thành công!',
        ]);
    }
    public function destroy(Request $request){
        $taikhoan = danhsachtaikhoan::find($request->id);
        if ($taikhoan){
            $taikhoan->delete();
            return response()->json([
                'status'    =>  1 ,
                'message'   => 'đã xóa tài khoản thành công',
            ]);
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'tài khoản không tồn tại!',
            ]);
        }

    }
    public function update(Request $request){
        $taikhoan = danhsachtaikhoan::find($request->id);
        if ($taikhoan){
            $data = $request->all();
            $taikhoan->update($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'cập nhật tài khoản thành công',
            ]);
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'tài khoản không tồn tại!',
            ]);
        }
    }
    public function status(Request $request){
        $taikhoan = danhsachtaikhoan::find($request->id);
        if($taikhoan){
            $taikhoan->tinh_trang = !$taikhoan->tinh_trang;
            $taikhoan->save();
            return response()->json([
                'status'    => 1,
                'message'   => 'cập nhật trạng thái thành công',
            ]);
        }else{
            return response()->json([
                'status'    => 0,
                'message'   => 'đổi trạng thái không thành công!',
            ]);
        }
    }

    public function timkiem(Request $request){
        $data   = danhsachtaikhoan::where('ho_va_ten','like','%'.$request->tt.'%')
        ->orwhere('email','like','%'.$request->tt.'%')
        ->orwhere('so_dien_thoai','like','%'.$request->tt.'%')
        ->get();

            return response()->json([
            'xxx'    => $data,
            ]);
    }

    public function timkiensdt(Request $request){
        $data   = danhsachtaikhoan::where('so_dien_thoai','LIKE','%'.$request->tt.'%')
        ->get();
            return response()->json([
            'xxx'    => $data,
            ]);
    }

    public function register(Request $request) {
        $data = $request->all();
        $data['is_block'] = 0;
        $data['tinh_trang'] = 1;
        $data['password'] = bcrypt($request->password);
        $data['thay_the_id'] = Str::uuid();
        danhsachtaikhoan::create($data);

        // $dataMail['ho_va_ten'] = $request->ho_va_ten;
        // $dataMail['link'] = 'http://127.0.0.1:8000/kich-hoat-tai-khoan/' . $data['thay_the_id'];
        // // dd($request->email);
        // // Mail::to($request->email)->send(new SendMail('KÍCH HOẠT TÀI KHOẢN', 'admin.pages.mail.mail_kichhoat', $dataMail));
        // SendMailJob::dispatch($request->email, 'KÍCH HOẠT TÀI KHOẢN', 'admin.pages.mail.mail_kichhoat', $dataMail);
        return response()->json([
            'status'    => 1,
            'message'   => 'Tạo Tài Khoản Thành Công',
        ]);
    }

    public function login(Request $request) {
        $check =  Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password]);

        if ($check == true) {
            $user =  Auth::guard('client')->user();
            // if (!$user->tinh_trang) {
            //     Auth::guard('client')->logout();
            //     return response()->json([
            //         'status'    => 0,
            //         'message'   => 'Bạn chưa xác minh tài khoản',
            //     ]);
            // }
            return response()->json([
                'status'    => 1,
                'message'   => 'Đăng Nhập Thành Công',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Sai Mật Khẩu Hoặc Tên Tài Khoản',
            ]);
        }


    }
}
