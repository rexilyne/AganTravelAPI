<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket_buses', function (Blueprint $table) {
            $table->id();
            $table->string('noBus');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('waktuBerangkat');
            $table->string('waktuTiba');
            $table->integer('harga');
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
        Schema::dropIfExists('tiket_buses');
    }
}
