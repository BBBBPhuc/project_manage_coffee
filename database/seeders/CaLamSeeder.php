<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaLamSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ca_lams')->delete();

        DB::table('ca_lams')->truncate();

        DB::table('ca_lams')->insert([
            [
                'ten_ca_lam'    => 'Ca Sáng',
                'gio_bat_dau'   => '06:00',
                'gio_ket_thuc'  => '12:00',
                'tinh_trang'    => 0,
            ],
            [
                'ten_ca_lam'    => 'Ca Chiều',
                'gio_bat_dau'   => '12:00',
                'gio_ket_thuc'  => '17:00',
                'tinh_trang'    => 0,
            ],
            [
                'ten_ca_lam'    => 'Ca Tối',
                'gio_bat_dau'   => '17:00',
                'gio_ket_thuc'  => '22:00',
                'tinh_trang'    => 0,
            ],
        ]);

    }
}
