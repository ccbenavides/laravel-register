<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\galeriaRequest;
use App\Http\Controllers\Controller;


class galeriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;
	private $pathImage;
	private $pathMiniImage;


    public function __construct(){
        $this->title = "gestionar albunes"; 
		$this->pathImage = "imagenes/galeria_imagen/album/";
		$this->pathMiniImage = "imagenes/galeria_imagen/album/miniatura/";
 
    }




    public function index(Request $request)
    {
        $order_dates = $this->ordenDireccion($request);

        $data = \App\GaleriaAlbum::nombre($request,$order_dates)
            ->leftjoin('galeria_imagen',
                    'galeria_album.id',
                    '=',
                    'galeria_imagen.galeriaalbum_id')
            ->groupBy('galeria_album.id')
            ->select([
                'galeria_album.*',
                'galeria_imagen.id as id_imagen',
                \DB::raw('count(galeria_imagen.id) as cant_imagenes')
            ])          
            ->paginate(7);
            
        return view('backend.galeria.index')->with([
                'title'=>$this->title,
                'sub'=>'Lista de Albunes',
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
        $lista_categoria = \App\Catgaleria::lists('nombre','id');
        return view('backend.galeria.create')->with([
                'title'=>$this->title, 
                'sub'=>'Nuevo Álbun', 
                'lista_categoria'=>$lista_categoria
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(galeriaRequest $request)
    {
        $galeria = new \App\GaleriaAlbum();
        $galeria->titulo = $request['titulo'];
        $galeria->descripcion = $request['descripcion'];
        $galeria->estado = $request['estado'];
        $galeria->categoria_id = $request['categoria_id'];
        $galeria->user_id = \Auth::user()->id;
        $galeria->save();
        return redirect()->route('backend.galeria.index');
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
        $galeria = \App\GaleriaAlbum::find($id);
        $lista_categoria = \App\Catgaleria::lists('nombre','id');

        return view('backend.galeria.edit')->with([
                        'title'=>$this->title,
                        'sub'=>'Publicación',
                        'galeria'=>$galeria,
                        'lista_categoria'=>$lista_categoria
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(galeriaRequest $request, $id)
    {
        $galeria = \App\GaleriaAlbum::find($id);
        $galeria->titulo = $request['titulo'];
        $galeria->descripcion = $request['descripcion'];
        $galeria->estado = $request['estado'];
        $galeria->categoria_id = $request['categoria_id'];
        $galeria->user_id = \Auth::user()->id;
        $galeria->save();
        $request->session()->flash('alert-success', 'Categoría Editada con exito!');
        return redirect()->route('backend.galeria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
       $data = \App\GaleriaAlbum::where('id',$request['date_eliminar'])
                ->first();
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.galeria.index');
    }

    public function agregarFotos($id){
        $galeria  = \App\GaleriaAlbum::find($id);
        $galeria->imagenes;
        return view('backend.galeria.galeria_foto')->with([
                'title'=>'Mantenimientos de fotos de Álbun',
                'sub'=>'Fotos',
                'galeria'=>$galeria
            ]);
    }

    public function guardarFotos(Request $request){
        $name_image = $this->imagenSaveResize($request->file('file'));
            
        $image = new \App\Imagen();
        $image->imagen = $name_image;
        $image->galeriaalbum_id = $request['gallery_id'];
        $image->save();
        return $image;

    }

    public function eliminarFoto($id){
            $imagen = \App\Imagen::find($id);
            \File::delete($this->pathImage.$imagen->imagen);
            \File::delete($this->pathMiniImage.$imagen->imagen);
            $imagen->delete();
            $message = 'El producto fue eliminado satisfactoriamente';
            return response()->json(['message' => $message]);
        
    }

    public function ordenDireccion($valor){
        
		if ($valor['activa'] ==0){
            return $valor['order_date'];
        }else{
            return  $valor['order_date']=='asc'?'desc':'asc';
        }
    }

    private function imagenSaveResize($param_file,$param_imagen = ""){
        $nombre_imagen= "";
        if ($param_file) {

			$file = $param_file;

			if (strlen($param_imagen)>0) {
                $nombre_imagen = $param_imagen;
			}else{
                $nombre_imagen = 'album_'.time()."". \Auth::user()->id.str_random(5) .'.'.$file->getClientOriginalExtension();

			}
			$imagen_original = \Image::make($param_file)
						 ->resize(1000,1000)
						 ->save($this->pathImage.$nombre_imagen);

            $imagen_miniatura = \Image::make($param_file)
                        ->resize(300,300)
                        ->save($this->pathMiniImage.$nombre_imagen);
        }
        return $nombre_imagen;
    }


	
}

