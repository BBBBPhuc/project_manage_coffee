<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhuVucSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('khu_vucs')->delete();

        DB::table('khu_vucs')->truncate();

        DB::table('khu_vucs')->insert([
            [
                'ten_khu_vuc'   => 'Tầng 1',
                'so_ban'        => 20,
                'tinh_trang'    => 1,
            ],
            [
                'ten_khu_vuc'   => 'Tầng 2',
                'so_ban'        => 10,
                'tinh_trang'    => 1,
            ],
        ]);
    }
}
