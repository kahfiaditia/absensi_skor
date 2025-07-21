<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pin', 4)->nullable();
            $table->string('nip', 15);
            $table->string('address', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('avatar', 64)->nullable();
            $table->string('roles', 15)->nullable();
            $table->datetime('date_login')->nullable();
            $table->datetime('date_logout')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
