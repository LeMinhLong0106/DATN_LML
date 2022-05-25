<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class KhachHang extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'khachhang';
    protected $fillable = [
        'tenkh',    'email',    'sdt',    'diachi',    'matkhau',    'google_id',
    ];
}
