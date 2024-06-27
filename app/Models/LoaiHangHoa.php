<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiHangHoa extends Model
{
    use HasFactory;
    protected $table = 'loai_hang_hoas';
    protected $fillable = [
        'ten_loai_hang',
        'hinh_anh',
        'tinh_trang',
    ];
}
