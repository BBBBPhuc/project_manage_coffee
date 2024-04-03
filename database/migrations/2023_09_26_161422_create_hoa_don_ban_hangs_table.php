<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hoa_don_ban_hangs', function (Blueprint $table) {
            $table->id();
            $table->integer('ma_hoa_don')->nullable();
            $table->integer('nguoi_tao_hoa_don')->nullable();
            $table->integer('id_nhan_vien')->nullable();;
            $table->integer('tong_tien')->nullable();
            $table->integer('giam_gia')->nullable();
            $table->integer('chi_phi_khac')->nullable();
            $table->integer('id_ban')->nullable();
            $table->integer('id_ca_lam')->nullable();
            $table->integer('is_thanh_toan')->nullable();
            $table->string('phuong_thuc_thanh_toan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hoa_don_ban_hangs');
    }
};
