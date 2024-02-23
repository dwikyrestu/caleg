<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDapilprovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dapilprov', function (Blueprint $table) {
            $table->increments('id_dapilprov');
            $table->string('nama_provinsi');
            $table->string('nama_dapilprov');
            $table->integer('kursi_dapilprov');
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
        Schema::dropIfExists('tbl_dapilprov');
    }
}
