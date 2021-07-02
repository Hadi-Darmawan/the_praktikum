<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModulPraktikum extends Model
{
    protected $table = 'tb_modul_praktikum';

    protected $fillable = [
        'id_praktikum',
        'file_modul',
    ];

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum', 'id');
    }
}
