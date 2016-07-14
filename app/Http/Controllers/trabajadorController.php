<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class trabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;
    public function __construct(){
        $this->title = "Mantenimiento De Trabajador";
        $this->pathImage = "imagenes/trabajador/";
        $this->pathMiniImage = "imagenes/trabajador/miniatura/";
    }

    public function index(Request $request)
    {

        $order_dates = $this->ordenDireccion($request);

        $data = \App\Trabajador::nombre($request,$order_dates)->paginate(5);
        return view('backend.trabajador.index')->with([
                    'title'=>$this->title,
                    'sub'=>'Lista de Trabajadores',
                    'nombre'=>$request['nombre'], 
                    'count'=>$data->total(), 
                    'order_date'=>$order_dates,
                    'data'=>$data
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('backend.trabajador.create')->with([
                'title'=>$this->title, 
                'sub' =>'Crear trabajador',
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
        $name_image = $this->imagenSaveResize($request->file('imagen'));

        $trabajador = new \App\Trabajador();
        $trabajador->dni = $request['dni'];
        $trabajador->nombres = $request['nombres'];
        $trabajador->apellidos = $request['apellidos'];
        $trabajador->sexo = $request['sexo'];
        $trabajador->foto = $name_image;
        $trabajador->fecha_nacimiento = $request['fecha_nacimiento'];
        $trabajador->direccion = $request['direccion'];
        $trabajador->referencia = $request['referencia'];
        $trabajador->telefono_fijo = $request['telefono_fijo'];
        $trabajador->telefono_movil = $request['telefono_movil'];
        $trabajador->correo_personal = $request['correo_personal'];
        $trabajador->correo_corporativo = $request['correo_corporativo'];
        $trabajador->estado = $request['estado'];

        $trabajador->save();

        $request->session()->flash('alert-success', 'Registrado con exito!');
        return redirect()->route('backend.trabajador.index');
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
        $trabajador = \App\Trabajador::find($id);

        
        return view('backend.trabajador.edit')->with([
                        'title'=>$this->title,
                        'sub'=>'Editar Trabajador',
                        'trabajador'=>$trabajador,
                        'aviso_imagen'=> $trabajador->foto,
                        'ruta_imagen'=>$this->pathMiniImage,
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
        $trabajador = \App\trabajador::find($id);
        $nombre_imagen = "";
        if(strlen($request->file('imagen'))>0){

           $nombre_imagen = $this->imagenSaveResize($request->file('imagen'),$trabajador->imagen);

        }elseif($request['bandera_eliminar_imagen'] == 'limpiando_imagen'){

            \File::delete($this->pathMiniImage.$trabajador->foto);
            \File::delete($this->pathImage.$trabajador->foto);
            $nombre_imagen = "";

        }elseif ($request['bandera_eliminar_imagen'] == 'no_hacer_nada') {

            $nombre_imagen = $trabajador->foto;

        }

        $trabajador->dni = $request['dni'];
        $trabajador->nombres = $request['nombres'];
        $trabajador->apellidos = $request['apellidos'];
        $trabajador->sexo = $request['sexo'];
        $trabajador->foto = $nombre_imagen;
        $trabajador->fecha_nacimiento = $request['fecha_nacimiento'];
        $trabajador->direccion = $request['direccion'];
        $trabajador->referencia = $request['referencia'];
        $trabajador->telefono_fijo = $request['telefono_fijo'];
        $trabajador->telefono_movil = $request['telefono_movil'];
        $trabajador->correo_personal = $request['correo_personal'];
        $trabajador->correo_corporativo = $request['correo_corporativo'];
        $trabajador->estado = $request['estado'];

        $trabajador->save();
        $request->session()->flash('alert-success', 'trabajador Editado con exito!');
        return redirect()->route('backend.trabajador.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data = \App\Trabajador::where('id',$request['date_eliminar'])
                ->first();
        \File::delete($this->pathMiniImage.$data->imagen);
        \File::delete($this->pathImage.$data->imagen);
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.trabajador.index');
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
                $nombre_imagen = 'trabajador_'.time()."". \Auth::user()->id.str_random(5) .'.'.$file->getClientOriginalExtension();

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
