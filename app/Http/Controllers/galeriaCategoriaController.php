<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\crearCategoriaGaleriaRequest;

class galeriaCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $title;
    private $path;
    private $pathMini;
    private $ruta_imagen;

    public function __construct(){
        $this->title = "Gestionar Galería";
        $this->path  = public_path() . '/imagenes/galeria_imagen/';
        $this->pathMini = public_path() . '/imagenes/galeria_imagen/miniatura/';
        $this->ruta_imagen ='/imagenes/galeria_imagen/miniatura/';

    }

    public function index(Request $request)
    {   
        if ($request['activa'] ==0){
               $order_dates = $request['order_date'];
            }else{
                $order_dates= $request['order_date']=='asc'?'desc':'asc';
             }

          $data = \App\Catgaleria::nombre($request['nombre'],$order_dates)                   
                    ->leftjoin('galeria_album',
                            'galeria_categoria.id',
                            '=',
                            'galeria_album.categoria_id')
                    ->groupBy('galeria_categoria.id')
                    ->select([
                        'galeria_categoria.*',
                        'galeria_album.id as id_publicacion',
                    \DB::raw('count(galeria_album.id) as albunes')])
                    ->paginate(7);

        return view('backend.galeria.indexCategoria')
                ->with([
                    'title'=>$this->title,
                    'sub' => 'Categorías de Galería',
                    'data'=> $data,
                    'order_date'=> $order_dates,
                    'nombre'=> $request['nombre'],
                    'count'=>$data->total()

                    ]);
        /*$nombre  = "";
        if(strlen($request['nombre'])>0 ){
            $nombre = $request['nombre'];

        }
        
        if( isset($request['order_date']) and $request['order_date']== '1' ){
          $order_date = '0';
          $data = \App\Catgaleria::nombre($request['nombre'])
                                ->orderBy('updated_at', 'asc')
                                 ->paginate(7);
        }else{
            $order_date = '1';
        $data = \App\Catgaleria::nombre($request['nombre'])
                                ->orderBy('updated_at', 'desc')
                                 ->paginate(7);

            
        }
          $count = \App\Catgaleria::nombre($request['nombre'])->count();
        return view('backend.galeria.indexCategoria')
                ->with([
                    'title'=>$this->title,
                    'sub' => 'Gestinar Galería',
                    'data'=> $data,
                    'order_date'=> $order_date,
                    'nombre'=> $nombre,
                    'count'=>$count
                    ]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.galeria.createCategoria')
                ->with([
                        'title'=>$this->title,
                        'sub'=>'Publicación',
                        'aviso_imagen'=>'normal',
                         'id_visible'=>''

                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre_imagen = $this->imagenSaveResize($request->file('imagen'));

        $cat_galeria = new \App\Catgaleria($request->all());
        $cat_galeria->user_id = \Auth::user()->id;
        $cat_galeria->imagen = $nombre_imagen;
        $boolean = $cat_galeria->save();

        $request->session()->flash('alert-success', 'Categoría registrada con exito!');
        return redirect()->route('backend.galeria_categoria.index');
    }


    public function edit($id)
    {
        $categoria = \App\Catgaleria::find($id);

        
        return view('backend.galeria.editCategoria')->with([
                        'title'=>$this->title,
                        'sub'=>'Publicación',
                        'categoria'=>$categoria,
                        'aviso_imagen'=> $categoria->imagen,
                        'ruta_imagen'=>$this->ruta_imagen,
                        'id_visible'=>''
                    ]);
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
        $categoria = \App\Catgaleria::find($id);

        if(strlen($request->file('imagen'))>0){

           $nombre_imagen = $this->imagenSaveResize($request->file('imagen'),$categoria->imagen);

        }elseif($request['bandera_eliminar_imagen'] == 'limpiando_imagen'){

            \File::delete($this->pathMini.$categoria->imagen);
            \File::delete($this->path.$categoria->imagen);
            $nombre_imagen = "";

        }elseif ($request['bandera_eliminar_imagen'] == 'no_hacer_nada') {

            $nombre_imagen = $categoria->imagen;

        }

  
        $categoria->nombre = $request['nombre'];
        $categoria->imagen = $nombre_imagen;
        $categoria->descripcion =$request['descripcion'];
        $categoria->estado = $request['estado'];
        $categoria->save();
        $request->session()->flash('alert-success', 'Categoría Editada con exito!');
        return redirect()->route('backend.galeria_categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
         $data = \App\Catgaleria::where('id',$request['date_eliminar'])
                ->first();
        \File::delete($this->pathMini.$data->imagen);
        \File::delete($this->path.$data->imagen);
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.galeria_categoria.index');
    }


    public function imagenSaveResize($param_file,$param_imagen = ""){
        $nombre_imagen= "";
        if ($param_file) {
           
           $file = $param_file;

           if (strlen($param_imagen)>0) {
                $nombre_imagen = $param_imagen;
           }else{
                $nombre_imagen = 'galeria_cat_'.time()."". \Auth::user()->id .'.'.$file->getClientOriginalExtension();

           }
           $imagen_original = \Image::make($param_file)
                        ->resize(1000,1000)
                        ->save($this->path.$nombre_imagen);

            $imagen_miniatura = \Image::make($param_file)
                        ->resize(300,300)
                        ->save($this->pathMini.$nombre_imagen);
        }
        return $nombre_imagen;
    }

}
