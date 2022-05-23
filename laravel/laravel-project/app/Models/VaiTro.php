<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;
    protected $table = 'vaitro';
    protected $fillable = [
        'tenvaitro', 'mota'
    ];

    public function vaitroquyen()
    {
        return $this->hasMany(VaiTroQuyen::class, 'vaitro_id');
    }

    public function quyens(){
        return $this->belongsToMany(Quyen::class, 'vaitro_quyen', 'vaitro_id', 'quyen_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
