<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RiwayatAbsen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("riwayat_absensi", function(Blueprint $table){
            $table->id();
            $table->string("id_user");
            $table->string("nama");
            $table->string("email");
            $table->string("keterangan");
            $table->string("deskripsi")->nullable();
            $table->text("gambar");
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
        Schema::dropIfExists("riwayat_absensi");
    }
}
