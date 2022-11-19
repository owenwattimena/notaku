<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_nota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->string('barang');
            $table->double('harga');
            $table->bigInteger('kuantitas');
            $table->bigInteger('diskon');

            $table->foreign('id_nota')->references('id')->on('nota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_nota');
    }
}
