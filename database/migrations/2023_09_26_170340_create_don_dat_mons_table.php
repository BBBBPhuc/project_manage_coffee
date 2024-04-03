<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('don_dat_mons', function (Blueprint $table) {
            $table->id();
            $table->integer('id_hang_hoa');
            $table->integer('so_luong');
            $table->integer('id_khach_hang')->nullable();
            $table->integer('id_nhan_vien')->nullable();
            $table->integer('ma_hoa_don')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('don_dat_mons');
    }
};
