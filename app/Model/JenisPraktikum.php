<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisPraktikum extends Model
{
    protected $table = 'tb_jenis_praktikum';

    protected $fillable = [
        'nama_praktikum',
        'semester',
        'konsentrasi',
        'deleted_at',
    ];
}
