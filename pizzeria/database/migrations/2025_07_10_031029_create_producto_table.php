<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreproducto', 100);
            $table->string('descripcionproducto', 150);
            $table->double('precioproducto', 10, 2);
            $table->integer('stock');
            $table->unsignedInteger('fktipoproducto');
            $table->boolean('activo')->default(true);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);

            // Llave foránea hacia tipoproducto
            $table->foreign('fktipoproducto')->references('id')->on('tipoproducto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
