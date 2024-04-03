<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuChi extends Model
{
    use HasFactory;

    protected $table = 'thu_chis';

    protected $fillable = [
        'thu_or_chi',
        'ten_nghiep_vu',
        'thanh_tien',
        'thoi_gian',
        'doi_tac',
        'minh_chung',
    ];
}
