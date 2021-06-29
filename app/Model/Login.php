<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'tb_login';

    protected $guard = 'login';

    protected $fillable = [
        'username',
        'password',
        'jabatan',
    ];

    protected $hidden = [
        'password'
    ];

    public function detailLogin(){
        return $this->hasOne(DetailLogin::class, 'id_login', 'id');
    }

    public function detailRole()
    {
        return $this->hasMany(DetailRole::class, 'id_login', 'id');
    }
}
