<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('appaterno', 100);
            $table->string('apmaterno', 100);
            $table->string('direccion', 300);
            $table->string('celular1', 15);
            $table->string('celular2', 15)->nullable();
            $table->unsignedBigInteger('fksexo');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('fksexo')->references('id')->on('sexo')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
