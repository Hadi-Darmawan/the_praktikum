<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailRole extends Model
{
    protected $table = 'tb_detail_role';

    protected $fillable = [
        'id_role',
        'id_login',
        'id_praktikum',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function login()
    {
        return $this->belongsTo(Login::class, 'id_login', 'id');
    }

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum', 'id');
    }
}
