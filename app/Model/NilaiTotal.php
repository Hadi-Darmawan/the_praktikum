<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NilaiTotal extends Model
{
    protected $table = 'tb_nilai_total';

    protected $fillable = [
        'id_praktikum',
        'id_login',
        'nilai_total',
        'nilai_huruf',
    ];

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum', 'id');
    }

    public function login()
    {
        return $this->belongsTo(Login::class, 'id_login', 'id');
    }
}
