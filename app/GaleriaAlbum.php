<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\scope;

class GaleriaAlbum extends Model
{
   use scope;
   protected $table = "galeria_album";


   public function imagenes(){
	   return $this->hasMany('\App\Imagen','galeriaalbum_id');
   }


}
