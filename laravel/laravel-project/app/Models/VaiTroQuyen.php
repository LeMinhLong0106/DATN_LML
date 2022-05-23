<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTroQuyen extends Model
{
    use HasFactory;
    protected $table = 'vaitro_quyen';
    protected $fillable = [
        'vaitro_id', 'quyen_id',
    ];

    public function vaitro()
    {
        return $this->belongsTo(VaiTro::class, 'vaitro_id');
    }

    public function quyen()
    {
        return $this->belongsTo(Quyen::class, 'quyen_id');
    }
}
