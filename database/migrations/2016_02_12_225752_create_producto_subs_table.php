<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_sub', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('imagen');
            $table->text('descripcion');
            $table->boolean('estado')->default(true);
            $table->integer('usuario_id');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('catalogo_categoria');
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
        Schema::drop('producto_sub');
    }
}
