<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catcatalogo extends Model
{
    protected $table = "catalogo_categoria";
  	
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
    public function catalogos(){
      return $this->hasMany('\App\Catalogo');
    }

   public function scopeNombre($query,$nombre,$order){

        return $query->where('nombre','like','%'.$nombre.'%')->orderBy('updated_at',$order);        
   
    }
}
