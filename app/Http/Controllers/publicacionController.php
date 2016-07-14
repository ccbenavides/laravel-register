<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\requestPublicacion;
use App\Http\Controllers\Controller;

class publicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;
    private $buscar;
    private $nombre_archivo;
    private $nombre_imagen;
 
    public function __construct(){
        $this->title = "Gestinar Publicaciones";
        $this->buscar = "";
        $this->nombre_archivo= "";
        $this->nombre_imagen="";


    }

    public function index(Request $request)
    {
        $this->buscar = "";
        $order_date = "";

        


        if(strlen($request['nombre'])>0 ){
            $this->buscar = $request['nombre'];

        }
        
        
        if( isset($request['order_date']) and $request['order_date']== '1' ){
          $order_date = '0';
            $data = \App\Publicacion::whereHas('idiomas', function ($query) {
                                    $query->where('titulo', 'like', '%'.$this->buscar. '%');
                                })->orderBy('updated_at', 'asc')->paginate(7);
        }else{
          $order_date = '1';
           $data = \App\Publicacion::whereHas('idiomas', function ($query) {
                                    $query->where('titulo', 'like', '%'.$this->buscar. '%');
                                })->orderBy('updated_at', 'desc')->paginate(7);

        }


          $data->each(function($categorias){
              $categorias->categoria;
              $categorias->idiomas;
          });

          
          $count = \App\Publicacion::whereHas('idiomas', function ($query) {
                                    $query->where('titulo', 'like', '%'.$this->buscar. '%');
                                })->count();


        foreach ($data as $valor) {
                $array[] = $valor->categoria;            
        }
        return view('backend.blog.index')
                ->with([
                    'title'=>$this->title,
                    'sub' => 'Gestinar Publicaciones',
                    'data'=> $data,
                    'order_date'=> $order_date,
                    'nombre'=> $this->buscar,
                    'count'=>$count
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_categoria = \App\Catblog::lists('nombre','id');
        return view('backend.blog.create')->with([
                    'title'=>$this->title,
                    'sub'=>'Crear Publicación',
                    'lista_categoria'=>$lista_categoria,
                    'id_visible'=>''
                ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requestPublicacion $request)
    {



        $this->imagenSaveResize($request->file('imagen'));
        $this->fileSave($request->file('archivo'));

       

        $publicacion = new \App\Publicacion($request->all());
        $publicacion->user_id = \Auth::user()->id;
        $publicacion->imagen = $this->nombre_imagen;
        $publicacion->archivo = $this->nombre_archivo;
        $publicacion->save();
        $publicacion->idiomas()->sync([
                                $request['idioma_id']=>[
                                'titulo'=>$request['titulo'],
                                'resumen'=>$request['resumen'],
                                'descripcion'=>$request['descripcion'] ]
                                ]);

        $request->session()->flash('alert-success', 'Categoría registrada con exito!');
        return redirect()->route('backend.blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $path = public_path() . '/imagenes/blog_imagen/publicaciones/';
        $data = \App\Publicacion::where('id',$request['date_eliminar'])
                ->first();
        \File::delete($path.'miniatura/'.$data->imagen);
        \File::delete(public_path().'/archivo/blog/'.$data->archivo);
        \File::delete($path.$data->imagen);
        $data->idiomas()->detach();
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.blog.index');
    }


    public function imagenSaveResize($param_file,$param_imagen = ""){
        if ($param_file) {
           $file = $param_file;
           $path = public_path() . '/imagenes/blog_imagen/publicaciones/';
           if (strlen($param_imagen)>0) {
                $this->nombre_imagen = $param_imagen;
           }else{
                $this->nombre_imagen = 'publicacion_'.time()."". \Auth::user()->id .'.'.$file->getClientOriginalExtension();

           }
           $imagen_original = \Image::make($param_file)
                        ->resize(1000,1000)
                        ->save($path.$this->nombre_imagen);

            $imagen_miniatura = \Image::make($param_file)
                        ->resize(300,300)
                        ->save($path.'/miniatura/'.$this->nombre_imagen);
        }
    }

    public function fileSave($parm_file){
        if($parm_file){
            $file = $parm_file;
            $this->nombre_archivo = 'archivo_'.time()."". \Auth::user()->id .'.'.$file->getClientOriginalExtension();

            $path = public_path() . '/archivo/blog/';
            $file->move($path,$this->nombre_archivo);
            
        }


    }

}
