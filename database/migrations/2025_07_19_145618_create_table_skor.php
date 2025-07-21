<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSkor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('kep_skor', function (Blueprint $table) {
            $table->id();
            $table->string('status_kehadiran', 50)->nullable(); // Contoh: 'terlambat', 'tidak hadir'
            $table->integer('skor')->nullable();
            $table->string('keterangan', 50)->nullable();// Contoh: 100, 70, 0
            $table->timestamps();
            $table->softDeletes(); // Jika ingin bisa dihapus sementara
        });
    }

    public function down()
    {
        Schema::dropIfExists('kep_skor');
    }
}
