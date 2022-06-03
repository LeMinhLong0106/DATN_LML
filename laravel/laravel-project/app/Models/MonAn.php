<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonAn extends Model
{
    use HasFactory;
    protected $table = 'monan';
    protected $fillable = [
        'tenmonan', 'tinhtrang', 'mota', 'hinhanh', 'gia', 'donvitinh', 'danhmuc', 'created_at'
    ];

    public function danhmucmonss()
    {
        return $this->belongsTo(DanhMuc::class, 'danhmuc', 'id');
    }

    public function cthds()
    {
        return $this->hasMany(CTHD::class, 'monan_id', 'id');
    }
}
