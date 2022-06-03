<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'bans';
    protected $fillable = [
        'ghe', 'tinhtrang', 'created_at', 'updated_at'
    ];

    public function hoadonss()
    {
        return $this->hasMany(HoaDon::class, 'ban_id', 'id');
    }
}
