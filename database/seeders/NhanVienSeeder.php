<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nhan_viens')->delete();

        DB::table('nhan_viens')->truncate();

        DB::table('nhan_viens')->insert([
            [
                'ten_nhan_vien'     => 'Minh Hiếu',
                'email'             => 'admin@gmail.com',
                'gioi_tinh'         => 0,
                'chuc_vu'           => 0,           //admin
                'ngay_vao_lam'      => '08/08/2023',
                'so_dien_thoai'     => '0974095458',
                'password'          => bcrypt(12345),
            ],
            [
                'ten_nhan_vien'     => 'Bảo Phúc',
                'email'             => 'phimmoizzzzz@gmail.com',
                'gioi_tinh'         => 1,
                'chuc_vu'           => 1,           //thu ngan
                'ngay_vao_lam'      => '08/10/2023',
                'so_dien_thoai'     => '0977578137',
                'password'          => bcrypt(12345)
            ],
            // [
            //     'ten_nhan_vien'     => 'Nhân viên 2',
            //     'gioi_tinh'         => 0,
            //     'chuc_vu'           => 2,           //nhan vien
            //     'ngay_vao_lam'      => '08/08/2023',
            //     'so_dien_thoai'     => '0923495458',
            //     'mat_khau'          => bcrypt(12345),
            // ],
        ]);
    }
}
