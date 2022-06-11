<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_alamat_pengiriman');
            $table->integer('jumlah');
            $table->integer('sub_total');
            $table->text('gambar')->nullable();
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->foreign('id_alamat_pengiriman')->references('id')->on('alamat_pengiriman');
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
        Schema::dropIfExists('carts');
    }
}
