<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSitioWeb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitio_web', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social',100)->unique();;
            $table->string('ruc',11)->unique();;
            $table->string('telefono_fijo',30);
            $table->string('telefono_movistar',30);
            $table->string('telefono_claro',30);
            $table->string('telefono_otro',30);
            $table->string('email',60)->unique();;
            $table->string('facebook_usuario',100)->unique();;
            $table->string('facebook_app_id',100)->unique();;
            $table->string('ruta_logo',200);
            
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
        Schema::drop('sitio_web');
    }
}
