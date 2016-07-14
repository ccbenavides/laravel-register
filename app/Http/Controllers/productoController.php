<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class productoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;


    public function __construct(){
        $this->title = "Gestionar Productos";
        $this->path = "imagenes/producto/";
        $this->pathMini = "imagenes/producto/miniatura/";      
    }


    public function index(Request $request)
    {
      /*  dd($request->all());*/
        $order_dates = $this->ordenDireccion($request);
        $data = \App\Producto::nombre($request['nombre'],$order_dates)
                                ->paginate(6);

        return view("backend.producto.index")->with([
                'title'=>$this->title, 
                'sub'=>'Listado De Productos', 
                'data'=>$data,
                'order_date'=> $order_dates,
                'nombre'=> $request['nombre'], 
                'count'=>$data->total(),
                'ruta_mini'=>$this->pathMini
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $lista_categorias = \App\Catcatalogo::lists('nombre','id');
         $lista_subCategorias = \App\ProductoSub::lists('nombre','id');
        return view('backend.producto.create')->with([
                'title'=>$this->title, 
                'sub'=>'Crear Producto', 
                'lista_categorias'=>$lista_categorias, 
                'lista_subCategorias'=>$lista_subCategorias,
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
      $data = new \App\Producto($request->all());
      $data->id_usuario = \Auth::user()->id;
      $data->imagen = $nombre_imagen;
      $data->save();
      $request->session()->flash('alert-success', 'Producto registrada con exito!');
      return redirect()->route('backend.producto.index');
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

        $producto  = \App\Producto::find($id);
        $lista_categorias = \App\Catcatalogo::lists('nombre','id');
        $lista_subCategorias = \App\ProductoSub::lists('nombre','id');
        return view('backend.producto.edit')->with([
                        'title'=>$this->title,
                        'sub'=>'Editar Producto',
                        'producto'=>$producto,
                        'lista_categorias'=>$lista_categorias, 
                        'lista_subCategorias'=>$lista_subCategorias,
                        'aviso_imagen'=> $producto->imagen,
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
        $data = \App\Producto::find($id);

        $nombre_imagen = "";
        if(strlen($request->file('imagen'))>0){

           $nombre_imagen = $this->imagenSaveResize($request->file('imagen'),$data->imagen);

        }elseif($request['bandera_eliminar_imagen'] == 'limpiando_imagen'){

            \File::delete($this->pathMini.$data->imagen);
            \File::delete($this->path.$data->imagen);
            $nombre_imagen = "";

        }elseif ($request['bandera_eliminar_imagen'] == 'no_hacer_nada') {

            $nombre_imagen = $data->imagen;

        }

       
         $data->fill($request->all());
         $data->imagen = $nombre_imagen;
         $data->id_usuario = \Auth::user()->id;
         $data->save();
         $request->session()->flash('alert-success', 'Producto Editado con exito!');
         return redirect()->route('backend.producto.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
         $data = \App\Producto::where('id',$request['date_eliminar'])
                ->first();
        \File::delete($this->pathMini.$data->imagen);
        \File::delete($this->path.$data->imagen);
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.producto.index');
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
