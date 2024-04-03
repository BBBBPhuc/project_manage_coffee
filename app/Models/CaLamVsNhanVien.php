<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaLamVsNhanVien extends Model
{
    use HasFactory;

    protected $table = 'ca_lam_vs_nhan_viens';

    protected $fillable = [
        'id_ca_lam',
        'id_nhan_vien',
    ];
}
