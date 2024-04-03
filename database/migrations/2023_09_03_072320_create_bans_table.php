<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->id();
            $table->string('ten_ban');
            $table->integer('id_khu_vuc');
            $table->integer('tinh_trang')->comment('-1: Ko sẵn sàng, 0: Sẵn sàng, 1: Đã Đặt');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('bans');
    }
};
