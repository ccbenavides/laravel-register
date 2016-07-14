<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
   protected $table  = "blog_publicacion";
   protected $fillable = ['imagen',
   						  'archivo',
   						  'estado',
   						  'user_id',
   						  'catblog_id'];

   public function idiomas(){
   		return $this->belongsToMany('\App\Idioma','blog_publicacion_idioma')->withPivot(
   													'titulo', 
   													'resumen',
   													'descripcion')->withTimestamps();
   }

   public function categoria(){
      return $this->belongsTo('\App\Catblog','catblog_id');
   }


}
