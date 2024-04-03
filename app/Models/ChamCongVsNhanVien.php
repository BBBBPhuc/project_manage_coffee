<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamCongVsNhanVien extends Model
{
    use HasFactory;

    protected $table = 'cham_cong_vs_nhan_viens';

    protected $fillable = [
        'id_nhan_vien',
        'id_cham_cong',
        'is_cham',
    ];
}
