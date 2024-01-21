<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excel_users extends Model
{
    protected $table = 'users';

    // Definisi relasi
    public function riwayatAbsensi()
    {
        return $this->hasMany(RiwayatAbsensi::class, 'id_user', 'id');
    }
}
