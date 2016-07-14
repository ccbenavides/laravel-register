<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GaleriaAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_album', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',100);
            $table->text('descripcion');
            $table->boolean('estado');
            $table->integer('user_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categoria_id')->references('id')->on('galeria_categoria');
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
        Schema::drop('galeria_album');
    }
}
