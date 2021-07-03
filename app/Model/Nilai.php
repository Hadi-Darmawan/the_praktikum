<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'tb_nilai';

    protected $fillable = [
        'id_login',
        'id_praktikum',
        'id_penilaian',
        'nilai',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'id_login', 'id');
    }

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum', 'id');
    }

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'id_penilaian', 'id');
    }
}
