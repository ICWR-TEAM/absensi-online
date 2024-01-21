<?php

namespace App\Exports;

use App\Excel_riwayat_presensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class RiwayatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = [[
            "No",
            'Nama',
            'Email',
            'Keterangan',
            "Deskripsi",
            "Waktu presensi"
        ]];
        $db = Excel_riwayat_presensi::getDataForExport();
        $no = 1;
        foreach ($db as $value) {
            $data[] = [
                "no"=>$no++,
                "nama"=>$value->name,
                "email"=>$value->email,
                "keterangan"=>$value->keterangan == "Hadir" ? "Hadir" : "Tidak hadir",
                "deskripsi"=>$value->keterangan == "Hadir" ? $value->deskripsi : "Belum presensi",
                "waktu"=>$value->keterangan == "Hadir" ? $value->updated_at : "Belum presensi"
            ];
        }
        return collect([$data]);
    }

}
