<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imagen');
            $table->integer('galeriaalbum_id')
                    ->unsigned();
            $table->foreign('galeriaalbum_id')
                    ->references('id')
                    ->on('galeria_album');
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
        Schema::drop('galeria_imagen');
    }
}
