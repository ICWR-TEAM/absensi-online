<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SettingAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("setting_absensi", function (Blueprint $table){
            $table->id();
            $table->string("buka_atau_tutup")->nullable();
            $table->string("tutup_otomatis");
            $table->string("buka_otomatis");
            $table->string("waktu_buka")->nullable();
            $table->string("waktu_tutup")->nullable();
            $table->string("deskripsi")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("setting_absensi");
    }
}
