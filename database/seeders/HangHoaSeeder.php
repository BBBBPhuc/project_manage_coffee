<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HangHoaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hang_hoas')->delete();

        DB::table('hang_hoas')->truncate();

        DB::table('hang_hoas')->insert([
            [
                'ten_hang_hoa'      => 'Cafe Phin Đen',
                'id_loai_hang_hoa'  => 2,
                'hinh_anh'          => 'https://doctormuoi.vn/wp-content/uploads/2021/01/cach-pha-cafe-phin.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 12000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
            [
                'ten_hang_hoa'      => 'Cafe Phin Sữa',
                'id_loai_hang_hoa'  => 2,
                'hinh_anh'          => 'https://ongbi.vn/wp-content/uploads/2023/01/pha-ca-phe-phun.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 14000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
            [
                'ten_hang_hoa'      => 'Cafe Đen Sài Gòn',
                'id_loai_hang_hoa'  => 2,
                'hinh_anh'          => 'https://shipdoandemff.com/wp-content/uploads/2018/03/C%C3%A0-ph%C3%AA-%C4%91en-S%C3%A0i-G%C3%B2n-1.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 16000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
            [
                'ten_hang_hoa'      => 'Cafe Sữa Sài Gòn',
                'id_loai_hang_hoa'  => 2,
                'hinh_anh'          => 'https://f5cafe.com/wp-content/uploads/2020/06/ca_phe_sua_da.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 18000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
            [
                'ten_hang_hoa'      => 'Bạc Xỉu',
                'id_loai_hang_hoa'  => 2,
                'hinh_anh'          => 'https://cdn.tgdd.vn/2021/03/content/Bac-xiu-la-gi-nguon-goc-va-cach-lam-bac-xiu-thom-ngon-don-gian-tai-nha-5-800x529.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 20000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
            [
                'ten_hang_hoa'      => 'Espresso Đen/ Đen Máy',
                'id_loai_hang_hoa'  => 1,
                'hinh_anh'          => 'https://bepnha.kingfoodmart.com/wp-content/uploads/2021/11/cach-lam-espresso-ca-phe-djen-kieu-y-thuc-uong-189612256774.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 20000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
            [
                'ten_hang_hoa'      => 'Espresso Sữa/ Sữa Máy',
                'id_loai_hang_hoa'  => 1,
                'hinh_anh'          => 'https://cdn.tgdd.vn/Files/2020/04/08/1247674/ca-phe-espresso-cappuccino-hay-macchiato-khac-nhau-nhu-the-nao-202004081936305660.jpg',
                'mo_ta'             => '',
                'gia_hang_hoa'      => 22000,
                'id_don_vi'            => 1,
                'tinh_trang'        => 1,
            ],
        ]);
    }
}
