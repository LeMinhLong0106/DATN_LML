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
            $table->string('hoten');
            $table->tinyInteger('gioitinh')->default(0);
            $table->date('ngaysinh')->nullable();
            $table->string('diachi');
            $table->string('sdt')->unique();
            $table->string('hinhanh')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('vaitro_id')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
