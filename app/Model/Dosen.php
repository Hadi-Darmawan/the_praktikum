<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'tb_dosen';

    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'username_telegram',
        'status',
    ];
}
