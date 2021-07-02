<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'tb_penilaian';

    protected $fillable = [
        'id_praktikum',
        'nama_penilaian',
        'persentase_nilai',
    ];

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum', 'id');
    }
}
