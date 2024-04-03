<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaLam extends Model
{
    use HasFactory;

    protected $table = 'ca_lams';

    protected $fillable = [
        'ten_ca_lam',
        'gio_bat_dau',
        'gio_ket_thuc',
        'tinh_trang',
    ];
}
