<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nhan_vien');
            $table->string('email');
            $table->integer('gioi_tinh')->comment('1: Nu, 0: Nam');
            $table->integer('chuc_vu');
            $table->string('ngay_vao_lam')->nullable();
            $table->string('so_dien_thoai');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
