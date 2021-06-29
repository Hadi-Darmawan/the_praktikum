<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'tb_role';

    protected $fillable = [
        'nama_role',
    ];

    public function detailRole()
    {
        return $this->hasMany(DetailRole::class, 'id_role', 'id');
    }
}
