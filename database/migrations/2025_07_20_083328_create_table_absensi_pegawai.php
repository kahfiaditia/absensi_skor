<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAbsensiPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kep_absensi', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->string('nip');
            $table->string('nama');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('hari_absen');
            $table->time('absen_karyawan')->nullable();
            $table->integer('keterlambatan')->nullable();
            $table->unsignedBigInteger('id_skor')->nullable();
            $table->integer('skor')->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kep_absensi');
    }
}
