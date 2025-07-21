<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDepartemen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kep_departemen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_departemen',10)->unique();
            $table->string('nama_departemen', 50)->nullable();
            $table->text('keterangan', 60)->nullable();
            $table->timestamps();
            $table->softDeletes(); // untuk fitur soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('kep_departemen');
    }
}
