<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excel_riwayat_presensi extends Model
{
    protected $table = 'riwayat_absensi';

        public function riwayatAbsensi()
        {
            return $this->hasMany(RiwayatAbsensi::class, 'id_user', 'id');
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'id_user', 'id');
        }

        public static function getDataForExport()
        {
            return self::rightJoin('users', 'riwayat_absensi.id_user', '=', 'users.id')
                ->where('users.role', '=', 'user')
                ->select('users.name', 'users.email', 'riwayat_absensi.keterangan', "riwayat_absensi.gambar", "riwayat_absensi.deskripsi", "riwayat_absensi.updated_at")
                ->orderByRaw("CASE WHEN riwayat_absensi.keterangan = 'Hadir' THEN 1 ELSE 2 END")
                ->get();
        }


}
