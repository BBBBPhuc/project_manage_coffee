<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PhuongThucThanhToanSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('phuong_thuc_thanh_toans')->delete();

        DB::table('phuong_thuc_thanh_toans')->truncate();

        DB::table('phuong_thuc_thanh_toans')->insert([
            [
                'ten_phuong_thuc'   => 'Tiền Mặt',
                'tinh_trang'        => 1,
            ],
            [
                'ten_phuong_thuc'   => 'Chuyển Khoản',
                'tinh_trang'        => 1,
            ],
        ]);

    }
}
