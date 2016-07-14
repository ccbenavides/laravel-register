<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoSub extends Model
{
    protected $table = "producto_sub";
    protected $fillable = [
    				'nombre',
                    'descripcion',
    				'imagen',
    				'estado',
    				'usuario_id',
    				'categoria_id'
    				];

   public function scopeNombre($query,$nombre,$order){
        return $query->where('producto_sub.nombre','like','%'.$nombre.'%')->orderBy('updated_at',$order);
      }  
}
