<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_departemen')->nullable()->after('name');
            $table->foreign('id_departemen')->references('id')->on('kep_departemen');
            $table->unsignedBigInteger('id_jabatan')->nullable()->after('id_departemen');
            $table->foreign('id_jabatan')->references('id')->on('kep_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_departemen']);
            $table->dropForeign(['id_jabatan']);

            // Hapus kolom
            $table->dropColumn(['id_departemen', 'id_jabatan']);
        });
    }
}
