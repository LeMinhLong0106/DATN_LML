<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    protected $fillable = ['tinhtrang', 'tongtien', 'hoten', 'diachi', 'sdt', 'songuoi', 'ghichu', 'nhanvien_id', 'nhanvien_tn', 'thoigianden', 'khachhang_id', 'ban_id', 'loaihd_id', 'created_at', 'updated_at'];

    public function cthds()
    {
        return $this->hasMany(CTHD::class, 'hoadon_id');
    }

    public function nhanvien()
    {
        return $this->belongsTo(User::class, 'nhanvien_id');
    }

    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'khachhang_id');
    }
}
