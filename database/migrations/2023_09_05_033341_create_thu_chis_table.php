<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('thu_chis', function (Blueprint $table) {
            $table->id();
            $table->integer('thu_or_chi')->comment('0: Thu; 1: Chi');
            $table->string('ten_nghiep_vu');
            $table->integer('thanh_tien');
            $table->string('thoi_gian');
            $table->string('doi_tac');
            $table->string('minh_chung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thu_chis');
    }
};
