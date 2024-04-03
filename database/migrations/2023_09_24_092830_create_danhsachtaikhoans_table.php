<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danhsachtaikhoans', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('so_dien_thoai');
            $table->date('ngay_sinh');
            $table->string('dia_chi');
            $table->string('ho_va_ten');
            $table->integer('is_block')->nullable();
            $table->integer('tinh_trang');
            $table->string('ma_doi_mat_khau')->nullable();
            $table->string('thay_the_id')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('danhsachtaikhoans');
    }
};
