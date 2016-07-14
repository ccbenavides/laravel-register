<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoImagen extends Model
{
    protected $table = "producto_imagen";
    protected $fillable = [
    			'imagen_producto',
    			'producto_id'
    			];
}
