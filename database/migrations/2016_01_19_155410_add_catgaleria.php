<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCatgaleria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_categoria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',80);
            $table->string('imagen');
            $table->mediumText('descripcion');
            $table->boolean('estado');
            $table->integer('user_id');



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
        Schema::drop('galeria_categoria');
    }
}
