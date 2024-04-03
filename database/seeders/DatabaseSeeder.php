<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LoaiHangHoa;
use App\Models\TaiKhoanCaLam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            LoaiHangHoaSeeder::class,
            DonViSeeder::class,
            HangHoaSeeder::class,
            KhuVucSeeder::class,
            NhanVienSeeder::class,
            CaLamSeeder::class,
        ]);
    }
}
