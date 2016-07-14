<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table = "idioma";
    protected $fillable = ['name'];
    
    public function publicaciones(){
    	return $this->belognsToMany('\App\Publicacion');
    }
    public $timestamps = false;

}
