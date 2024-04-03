<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;

    protected $table = 'bans';
    protected $fillable = [
        'ten_ban',
        'id_khu_vuc',
        'tinh_trang',
    ];

    CONST BAN_SAN_SANG = 0;
    CONST BAN_DA_DAT = 1;
    CONST BAN_KHONG_THE_DUNG = -1;
}
