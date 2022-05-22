<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    // use HasFactory;
    public $timestamps = false;
    protected $table = 'danhmucmon';
    protected $fillable = [
        'tendm', 'uutien'
    ];

    public function monan()
    {
        return $this->hasMany(Monan::class, 'danhmuc', 'id');
    }
}
