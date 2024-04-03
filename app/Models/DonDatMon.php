<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonDatMon extends Model
{
    use HasFactory;

    protected $table = 'don_dat_mons';

    protected $fillable = [
       'id_hang_hoa',
       'so_luong',
       'id_khach_hang'
    ];
}
