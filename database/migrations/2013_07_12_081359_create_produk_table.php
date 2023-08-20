<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('namaproduk');
            $table->string('slug');
            $table->bigInteger('kategoris_id')->unsigned()->nullable();
            $table->string('harga');
            $table->string('diskon');
            $table->string('berat');
            $table->string('deskripsi');
            $table->string('gambarproduk1');
            $table->string('gambarproduk2');
            $table->string('gambarproduk3');
            $table->string('gambarproduk4');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('produk');
    }
}
