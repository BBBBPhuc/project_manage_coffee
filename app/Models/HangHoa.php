<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangHoa extends Model
{
    use HasFactory;

    protected $table = 'hang_hoas';

    protected $fillable = [
        'ten_hang_hoa',
        'id_loai_hang_hoa',
        'hinh_anh',
        'mo_ta',
        'gia_hang_hoa',
        'id_don_vi',
        'tinh_trang',
    ];
}
