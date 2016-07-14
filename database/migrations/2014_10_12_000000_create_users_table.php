<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idioma', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
        });

        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',60)->unique();
            $table->string('descripcion');
            $table->timestamps();
        });

        Schema::create('trabajadores', function (Blueprint $table) {
            $table->increments('id');
            $table->char('dni',8)->unique();
            $table->string('nombres',120);
            $table->string('apellidos',120);
            $table->boolean('sexo');
            $table->string('foto');
            $table->date('fecha_nacimiento');
            $table->string('direccion');
            $table->string('referencia');
            $table->string('telefono_fijo');
            $table->string('telefono_movil');
            $table->string('correo_personal',80)->unique();
            $table->string('correo_corporativo',80)->unique();
            $table->boolean('estado');
            $table->timestamps();
        });


        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',30)->unique();
            $table->string('password', 60);
            $table->boolean('estado')->default(true);
            $table->dateTime('ultima_conexion')->default(null);
            $table->boolean('forzar_clave')->default(false);
            $table->integer('trabajador_id')
                    ->nullable()
                    ->unsigned();
            $table->foreign('trabajador_id')
                    ->references('id')
                    ->on('trabajadores');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('permiso_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('permiso_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('permiso_id')
                    ->references('id')
                    ->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('idioma');
        Schema::drop('user_permiso');
        Schema::drop('users');
        Schema::drop('permisos');
    }
}
