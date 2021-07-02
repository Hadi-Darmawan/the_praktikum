<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AsistenPraktikum extends Model
{
    protected $table = 'tb_asisten_praktikum';

    protected $fillable = [
        'id_login',
        'id_praktikum',
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
