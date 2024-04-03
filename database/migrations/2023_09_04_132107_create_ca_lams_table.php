<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ca_lams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_ca_lam');
            $table->time('gio_bat_dau');
            $table->time('gio_ket_thuc');
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ca_lams');
    }
};
