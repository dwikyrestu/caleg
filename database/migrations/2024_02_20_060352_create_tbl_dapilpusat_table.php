<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDapilpusatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dapilpusat', function (Blueprint $table) {
            $table->increments('id_dapilpusat');
            $table->string('nama_provinsi');
            $table->string('nama_dapilpusat');
            $table->integer('kode_dapilpusat');
            $table->integer('kursi_dapilpusat');
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
        Schema::dropIfExists('tbl_dapilpusat');
    }
}
