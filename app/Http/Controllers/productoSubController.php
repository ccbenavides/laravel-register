<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class productoSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;


    public function __construct(){
        $this->title = "Gestionar Sub Categoría";
        $this->path = "imagenes/producto/sub_categoria/";
        $this->pathMini = "imagenes/producto/sub_categoria/miniatura/";
      
    }

    public function index(Request $request)
    {
        $order_dates = $this->ordenDireccion($request);

        $data = \App\ProductoSub::nombre($request['nombre'],$order_dates)
                        ->select(
                                'catalogo_categoria.id as clave_categoria',
                                'catalogo_categoria.nombre as nombre_categoria',
                                'producto_sub.*'
                                )
                        ->leftjoin(
                                'catalogo_categoria',
                                'producto_sub.categoria_id',
                                '=',
                                'catalogo_categoria.id'
                                )
                        ->paginate(7);
        return view('backend.producto_subcategoria.index')->with([
                'title'=>$this->title,
                'sub'=>'Lista de SubCategorias - Productos',
                'data'=> $data,
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
        return view('backend.producto_subcategoria.create')->with([
                'title'=>$this->title, 
                'sub'=>'SubCategoria - Producto',
                'lista_categorias'=>$lista_categorias,
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
      $data = new \App\ProductoSub($request->all());
      $data->usuario_id = \Auth::user()->id;
      $data->imagen = $nombre_imagen;
      $data->save();
      $request->session()->flash('alert-success', 'SubCategoría registrada con exito!');
      return redirect()->route('backend.subcategoria_producto.index');
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
        $subcategoria  = \App\ProductoSub::find($id);
        $lista_categorias = \App\Catcatalogo::lists('nombre','id');
        
        return view('backend.producto_subcategoria.edit')->with([
                        'title'=>$this->title,
                        'sub'=>'Editar Categoria - Producto',
                        'subcategoria'=>$subcategoria,
                        'lista_categorias'=>$lista_categorias,
                        'aviso_imagen'=> $subcategoria->imagen,
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
        $sub_cat = \App\ProductoSub::find($id);
        $nombre_imagen = "";
        if(strlen($request->file('imagen'))>0){

           $nombre_imagen = $this->imagenSaveResize($request->file('imagen'),$sub_cat->imagen);

        }elseif($request['bandera_eliminar_imagen'] == 'limpiando_imagen'){

            \File::delete($this->pathMini.$sub_cat->imagen);
            \File::delete($this->path.$sub_cat->imagen);
            $nombre_imagen = "";

        }elseif ($request['bandera_eliminar_imagen'] == 'no_hacer_nada') {

            $nombre_imagen = $sub_cat->imagen;

        }

        $sub_cat->nombre =  $request['nombre'];
        $sub_cat->descripcion = $request['descripcion'];
        $sub_cat->imagen =  $nombre_imagen;
        $sub_cat->estado = $request['estado'];
        $sub_cat->usuario_id = \Auth::user()->id;
        $sub_cat->categoria_id = $request['categoria_id'];
        $sub_cat->save();
 
        $request->session()->flash('alert-success', 'SubCategoría Editada con exito!');
        return redirect()->route('backend.subcategoria_producto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
       $data = \App\ProductoSub::where('id',$request['date_eliminar'])
                ->first();
        \File::delete($this->pathMini.$data->imagen);
        \File::delete($this->path.$data->imagen);
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.subcategoria_producto.index');
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
