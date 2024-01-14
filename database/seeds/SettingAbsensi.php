<?php

use Illuminate\Database\Seeder;

class SettingAbsensi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SettingAbsensi::create([
            "buka_atau_tutup"=>"buka",
            "tutup_otomatis"=>"tidak",
            "buka_otomatis"=>"tidak",
        ]);
    }
}
