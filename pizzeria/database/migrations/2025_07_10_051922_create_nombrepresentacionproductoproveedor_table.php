<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNombrepresentacionproductoproveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentacionproductoproveedor', function (Blueprint $table) {
            $table->id();
            $table->string('nombrepresentacionproductoproveedor', 50);
            $table->boolean('activo')->default(true);
            $table->timestamps(); // esto incluye created_at y updated_at como TIMESTAMP NULL DEFAULT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nombrepresentacionproductoproveedor');
    }
}
