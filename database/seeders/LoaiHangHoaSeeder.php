<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiHangHoaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('loai_hang_hoas')->delete();

        DB::table('loai_hang_hoas')->truncate();

        DB::table('loai_hang_hoas')->insert([
            [
                'ten_loai_hang' => 'CaFe Máy',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'CaFe Phin',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'Đá Xay',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'Nước Ép',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'Trà Trái Cây',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'SoDa',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'Hot Drink',
                'tinh_trang'    => 1,
            ],
            [
                'ten_loai_hang' => 'Sữa Chua',
                'tinh_trang'    => 1,
            ],
        ]);
    }
}
