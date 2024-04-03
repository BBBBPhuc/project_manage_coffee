<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongThucThanhToan extends Model
{
    use HasFactory;

    protected $table = 'phuong_thuc_thanh_toans';

    protected $fillable = [
        'ten_phuong_thuc',
        'tinh_trang',
    ];
}
