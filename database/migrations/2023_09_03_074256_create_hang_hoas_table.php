<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hang_hoas', function (Blueprint $table) {
            $table->id();
            $table->string('ten_hang_hoa');
            $table->integer('id_loai_hang_hoa');
            $table->string('hinh_anh');
            $table->text('mo_ta');
            $table->integer('gia_hang_hoa');
            $table->integer('id_don_vi');
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hang_hoas');
    }
};
