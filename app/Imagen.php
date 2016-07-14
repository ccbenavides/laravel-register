<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
   protected $table = "galeria_imagen";
   protected $fillable = [
   			'imagen',
   			'galeriaalbum_id'
   			];
   public function galeria(){
   	return $this->belongsTo('\App\GaleriaAlbum');
   }
}
