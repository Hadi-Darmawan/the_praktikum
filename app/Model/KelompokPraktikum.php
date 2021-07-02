<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KelompokPraktikum extends Model
{
    protected $table = 'tb_kelompok_praktikum';

    protected $fillable = [
        'id_praktikum',
        'id_asisten_praktikum',
        'id_peserta_praktikum',
        'kelompok',
    ];

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum', 'id');
    }

    public function asistenPraktikum()
    {
        return $this->belongsTo(Login::class, 'id_asisten_praktikum', 'id');
    }

    public function pesertaPraktikum()
    {
        return $this->belongsTo(Login::class, 'id_peserta_praktikum', 'id');
    }
}
