<?php 
namespace App\Http\Controllers\Traits;

trait scope
{
	public function scopeNombre($query,$request,$order){
		
	   return $query->where('titulo','like','%'.$request['nombre'].'%')->orderBy('updated_at',$order);
	   
   }	
}
