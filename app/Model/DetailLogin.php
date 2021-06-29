<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailLogin extends Model
{
    protected $table = 'tb_detail_login';

    protected $fillable = [
        'id_login',
        'nama',
        'nim',
        'angkatan',
        'nomor_telepon',
        'username_telegram',
        'line_id',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'id_login', 'id');
    }
}
