<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_buses', function (Blueprint $table) {
            $table->id();
            $table->string('noBus');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('waktuBerangkat');
            $table->string('waktuTiba');
            $table->integer('harga');
            $table->integer('idUser');
            $table->integer('jumlahPenumpang');
            $table->integer('totalHarga');
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
        Schema::dropIfExists('order_buses');
    }
}
