<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDapildprdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dapildprd', function (Blueprint $table) {
            $table->increments('id_dapildprd');
            $table->string('nama_provinsi');
            $table->string('nama_kota');
            $table->integer('dapil_1');
            $table->integer('dapil_2');
            $table->integer('dapil_3');
            $table->integer('dapil_4');
            $table->integer('dapil_5');
            $table->integer('dapil_6');
            $table->integer('dapil_7');
            $table->integer('dapil_8');
            $table->integer('dapil_9');
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
        Schema::dropIfExists('tbl_dapildprd');
    }
}
