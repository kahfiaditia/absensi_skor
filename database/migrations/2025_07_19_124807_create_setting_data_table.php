<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('kep_setting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hari')->nullable();
            $table->foreign('id_hari')->references('id')->on('kep_hari');
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->timestamps();
            $table->softDeletes(); // Tambahkan soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('setting_data');
    }
}
