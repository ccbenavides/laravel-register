<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
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
            $table->string('nombre');
            $table->float('precio');
            $table->text('descripcion');
            $table->string('imagen');

            $table->integer('id_categoria')->unsigned();
            $table->integer('id_subcategoria')->unsigned();
            $table->integer('id_usuario')->unsigned();

            $table->foreign('id_categoria')
                    ->references('id')
                    ->on('catalogo_categoria');

            $table->foreign('id_subcategoria')
                    ->references('id')
                    ->on('producto_sub');

            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('users');

            $table->timestamps();
        });

        Schema::create('producto_imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imagen_producto');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')
                    ->references('id')
                    ->on('producto');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producto');
        Schema::drop('producto_imagen');
    }
}
