<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlogPublicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_publicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imagen');
            $table->string('archivo');
            $table->boolean('estado');
            $table->integer('visitas')->default(0);

            $table->integer('user_id')->unsigned();
            $table->integer('catblog_id')->unsigned();

            $table->foreign('catblog_id')
                    ->references('id')
                     ->on('blog_categoria');

            $table->foreign('user_id')
                    ->references('id')
                     ->on('users');

            $table->timestamps();
        });

        Schema::create('blog_publicacion_idioma',function(Blueprint $table){
            $table->increments('id');

            $table->string('titulo');
            $table->text('resumen');
            $table->text('descripcion');
            $table->integer('idioma_id')->unsigned();
            $table->integer('publicacion_id')->unsigned();

            $table->foreign('idioma_id')
                    ->references('id')
                     ->on('idioma');
            $table->foreign('publicacion_id')
                    ->references('id')
                     ->on('blog_publicacion');
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
        Schema::drop('blog_publicacion');
    }
}
