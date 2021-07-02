<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    protected $table = 'tb_praktikum';

    protected $fillable = [
        'id_jenis_praktikum',
        'dosen_pengampu',
        'ketua_praktikum',
        'tahun',
    ];

    public function jenis_praktikum()
    {
        return $this->belongsTo(JenisPraktikum::class, 'id_jenis_praktikum', 'id');
    }

    public function asistenPraktikum()
    {
        return $this->hasMany(AsistenPraktikum::class, 'id_praktikum', 'id');
    }

    public function kelompokPraktikum()
    {
        return $this->hasMany(KelompokPraktikum::class, 'id_praktikum', 'id');
    }

    public function modulPraktikum()
    {
        return $this->hasOne(ModulPraktikum::class, 'id_praktikum', 'id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_praktikum', 'id');
    }
}
