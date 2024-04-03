<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonViSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('don_vis')->delete();

        DB::table('don_vis')->truncate();

        DB::table('don_vis')->insert([
            [
                'ten_don_vi'    => 'Ly',
                'tinh_trang'    =>  1,
            ],
            [
                'ten_don_vi'    => 'Bao',
                'tinh_trang'    =>  1,
            ],
            [
                'ten_don_vi'    => 'Điếu',
                'tinh_trang'    =>  1,
            ],
            [
                'ten_don_vi'    => 'Bịch',
                'tinh_trang'    =>  1,
            ],
            [
                'ten_don_vi'    => 'Kilogram',
                'tinh_trang'    =>  1,
            ],
            [
                'ten_don_vi'    => 'Lít',
                'tinh_trang'    =>  1,
            ],
        ]);
    }
}
