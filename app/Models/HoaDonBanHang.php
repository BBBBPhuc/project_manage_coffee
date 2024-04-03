<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonBanHang extends Model
{
    use HasFactory;

    protected $table = 'hoa_don_ban_hangs';

    protected $fillable = [
        'ma_hoa_don',
        'nguoi_tao_hoa_don',
        'id_nhan_vien',
        'tong_tien',
        'giam_gia',
        'chi_phi_khac',
        'id_ban',
        'id_ca_lam',
        'is_thanh_toan',
        'id_phuong_thuc_thanh_toan',
    ];
}
