<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "sitio_web";
    protected $fillable = [
    		  'razon_social',
    		  'ruc',
    		  'telefono_fijo',
    		  'telefono_movistar',
    		  'telefono_claro',
    		  'telefono_otro',
    		  'email',
    		  'facebook_usuario',
    		  'facebook_app_id',
    		  'ruta_logo'
    		  ];
}
