<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";
    protected $fillable = [
    				'nombre',
    				'precio',
    				'descripcion',
    				'imagen',
    				'id_categoria',
    				'id_subcategoria',
    				'id_usuario'
    				];

public function scopeNombre($query,$nombre,$order){

        return $query->where('nombre','like','%'.$nombre.'%')->orderBy('updated_at',$order);        
   
    }

    		
}
