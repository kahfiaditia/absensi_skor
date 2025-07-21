<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kep_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jabatan', 50)->unique();
            $table->string('nama_jabatan', 50)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->timestamps();
            $table->softDeletes(); // Untuk fitur soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('kep_jabatan');
    }
}
