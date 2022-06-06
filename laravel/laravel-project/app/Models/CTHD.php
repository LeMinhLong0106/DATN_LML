<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTHD extends Model
{
    use HasFactory;
    protected $table = 'cthd';
    protected $fillable = [
        'hoadon_id', 'monan_id', 'soluong', 'giaban', 'tongtien', 'ghichu', 'tinhtrang'
    ];

    public function monanss()
    {
        return $this->belongsTo(Monan::class, 'monan_id');
    }

    public function hoadonss()
    {
        return $this->belongsTo(HoaDon::class, 'hoadon_id');
    }

    
}
