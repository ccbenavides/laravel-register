<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catgaleria extends Model
{
  	protected $table = "galeria_categoria";
  	
  	protected $fillable =[
  						'nombre',
  						'imagen',
  						'descripcion',
  						'estado',
  						'user_id'
  						];

  	public function user(){
  		return $this->belongsTo('\App\User');
  	}

    public function galerias(){
      return $this->hasMany('\App\Galeria');
    }

    public function scopeNombre($query,$nombre,$order){

        return $query->where('nombre','like','%'.$nombre.'%')->orderBy('updated_at',$order);        
   
    }

}
