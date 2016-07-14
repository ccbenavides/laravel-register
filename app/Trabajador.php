<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table  = "trabajadores";
    public function scopeNombre($query,$request,$order){
        return $query->where('nombres','like','%'.$request['nombre'].'%')->orderBy('updated_at',$order);
      }  
}
