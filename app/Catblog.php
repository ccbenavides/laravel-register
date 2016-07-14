<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Catblog extends Model
{
    protected $table = "blog_categoria";
    protected $cantidadPublicaciones = 0;
  	
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

    public function publicaciones(){
      return $this->hasMany('\App\Publicacion');
    }

    public function scopeNombre($query,$nombre,$order){

        return $query->where('nombre','like','%'.$nombre.'%')->orderBy('updated_at',$order);        
   
    }

    public function getCantidadPublicaciones(){
        return $this->cantidadPublicaciones;
    }

    public function setCantidadPublicaciones($value){
      $this->cantidadPublicaciones = $value;
    }
    
    
    public function contadorPublicaciones(){
      return $this->orderBy('updated_at', 'asc')
        ->leftjoin('blog_publicacion',
                'blog_categoria.id',
                '=',
                'blog_publicacion.catblog_id')
        ->groupBy('blog_categoria.id')
        ->select([
            'blog_categoria.*',
            'blog_publicacion.id as id_publicacion',
        \DB::raw('count(blog_publicacion.id) as publicaciones')])
        ->paginate(7);
      /*return $this->publicaciones->groupBy('blog_publicacion.estado')->get();*/
    }
      
    
}
