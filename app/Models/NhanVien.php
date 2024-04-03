<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class NhanVien extends Authenticatable
{
    use HasFactory;

    protected $table = 'nhan_viens';

    protected $fillable = [
        'ten_nhan_vien',
        'email',
        'gioi_tinh',
        'chuc_vu',
        'ngay_vao_lam',
        'so_dien_thoai',
        'password',
    ];
}
