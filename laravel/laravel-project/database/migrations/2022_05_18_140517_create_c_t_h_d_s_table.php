<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCTHDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cthd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hoadon_id');
            $table->integer('monan_id');
            $table->string('soluong')->default(0);
            $table->string('giaban')->default(0);
            $table->string('ghichu')->nullable();
            $table->string('tinhtrang')->default(0);
            $table->string('tongtien')->default(0);
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
        Schema::dropIfExists('cthd');
    }
}
