<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class catologoCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $title;


    public function __construct(){
        $this->title = "Gestionar Catalogo";
        $this->path = "imagenes/catalogo_imagen/";
        $this->pathMini = "imagenes/catalogo_imagen/miniatura/";
      
    }

    public function index(Request $request)
    {
        $order_dates = $this->ordenDireccion($request);

        $data = \App\Catcatalogo::nombre($request['nombre'],$order_dates)->paginate(7);
            
        return view('backend.catalogo.indexCategoria')->with([
                'title'=>$this->title,
                'sub'=>'Lista de Categorias - Productos',
                'data'=> $data,
                'order_date'=> $order_dates,
                'nombre'=> $request['nombre'],
                'count'=>$data->total()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.catalogo.createCategoria')->with([
                'title'=>$this->title, 
                'sub'=>'Categoria - Producto',
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

        $catalogo_cat = new \App\Catcatalogo($request->all());
        $catalogo_cat->user_id = \Auth::user()->id;
        $catalogo_cat->imagen = $nombre_imagen;
        $boolean = $catalogo_cat->save();

        $request->session()->flash('alert-success', 'Categoría registrada con exito!');
        return redirect()->route('backend.catalogo_categoria.index');
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
       $categoria_producto = \App\Catcatalogo::find($id);

        
        return view('backend.catalogo.editCategoria')->with([
                        'title'=>$this->title,
                        'sub'=>'Editar Categoria - Producto',
                        'categoria'=>$categoria_producto,
                        'aviso_imagen'=> $categoria_producto->imagen,
                        'ruta_imagen'=>$this->pathMini,
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
       $categoria = \App\Catcatalogo::find($id);

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
        return redirect()->route('backend.catalogo_categoria.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data = \App\Catcatalogo::where('id',$request['date_eliminar'])
                ->first();
        \File::delete($this->pathMini.$data->imagen);
        \File::delete($this->path.$data->imagen);
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.catalogo_categoria.index');
    }

    public function ordenDireccion($valor){
        
        if ($valor['activa'] ==0){
            return $valor['order_date'];
        }else{
            return  $valor['order_date']=='asc'?'desc':'asc';
        }
    }


     public function imagenSaveResize($param_file,$param_imagen = ""){
        $nombre_imagen= "";
        if ($param_file) {
           
           $file = $param_file;

           if (strlen($param_imagen)>0) {
                $nombre_imagen = $param_imagen;
           }else{
                $nombre_imagen = 'producto_cat_'.time()."". \Auth::user()->id .'.'.$file->getClientOriginalExtension();

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
