<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\Http\Requests\usuarioRequest;
use App\Http\Controllers\Controller;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;
    public function __construct(){
        $this->title = "Mantenimiento Usuario";
    }

    public function index(Request $request)
    {

        $order_dates = $this->ordenDireccion($request);

        $data = \App\User::nombre($request,$order_dates)
                         ->leftjoin('trabajadores','users.trabajador_id','=','trabajadores.id')
                         ->select('trabajadores.id as id_trabajador','trabajadores.nombres','users.*')
                         ->paginate(5);
                         
        $data->each(function($user){
            $user->permisos;
        });

        return view('backend.usuario.index')->with([
                    'title'=>$this->title,
                    'sub'=>'Lista de Usuarios',
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
          $lista_permisos = \App\Permiso::lists('descripcion', 'id');
          $lista_trabajadores = \App\Trabajador::leftjoin('users', 'users.trabajador_id', '=', 'trabajadores.id')
                                                ->select('users.id as id_usuario','users.trabajador_id','trabajadores.nombres','trabajadores.id')
                                                ->where('trabajador_id',null)
                                                ->lists('nombres', 'id');
        return view('backend.usuario.create')->with([
                'title'=>$this->title, 
                'sub' =>'Crear Usuario',
                'lista_permisos'=>$lista_permisos,
                'lista_trabajadores'=>$lista_trabajadores,
                'lista_permisos_id'=>[]

            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(usuarioRequest $request)
    {
        $usuario = new \App\User();
        $usuario->username = $request['username'];
        $usuario->password = bcrypt($request['username']);
        $usuario->estado = $request['estado'];
        
        if(isset($request['trabajador_id'])){
            $usuario->trabajador_id = ($request['trabajador_id']<>"")?$request['trabajador_id']:null;
        }else{
            $usuario->trabajador_id = null;
        }
        $usuario->save();        
        $usuario->permisos()->sync($request['permisos']);


        $request->session()->flash('alert-success', 'Registrado con exito!');
        return redirect()->route('backend.usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {
         $usuario_conectado = \Auth::user();

       if($usuario_conectado->id == $id){
            $request->session()->flash('alert-danger', 'No se puede editar usted mismo!');
            return redirect()->route('backend.usuario.index');    
       }else{

        $lista_permisos = \App\Permiso::lists('descripcion', 'id');


        $usuario = \App\User::find($id);
        $lista_permisos_id = $usuario->permisos->lists('id')->toArray();
        $lista_trabajadores = \App\Trabajador::leftjoin('users', 'users.trabajador_id', '=', 'trabajadores.id')
                                                ->select('users.id as id_usuario','users.trabajador_id','trabajadores.nombres','trabajadores.id')
                                                ->where('trabajador_id',null)
                                                ->lists('nombres', 'id');
        
        return view('backend.usuario.edit')->with([
                        'title'=>$this->title,
                        'sub'=>'Editar usuario',
                        'usuario'=>$usuario,
                        'lista_trabajadores'=>$lista_trabajadores,
                        'lista_permisos'=>$lista_permisos,
                        'lista_permisos_id'=>$lista_permisos_id
                    ]);
       }
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
        $usuario = \App\User::find($id);
        $usuario->estado = $request['estado'];
        if(isset($request['trabajador_id'])){
            $usuario->trabajador_id = ($request['trabajador_id']<>"")?$request['trabajador_id']:null;
        }
        $usuario->save();        
        $usuario->permisos()->sync($request['permisos']);
        $request->session()->flash('alert-success', 'Editado con exito!');
        return redirect()->route('backend.usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $usuario_conectado = \Auth::user();

       if($usuario_conectado->id == $request['date_eliminar']){
            $request->session()->flash('alert-danger', 'No se puede eliminar a usted mismo, esta logeado!');
            return redirect()->route('backend.usuario.index');    
       }else{

        $data = \App\User::where('id',$request['date_eliminar'])
                ->first();
        $data->delete();
        $request->session()->flash('alert-warning', 'El registro fue eliminado con exito!');
        return redirect()->route('backend.usuario.index');
       }

    }

    
    //GET 
    public function getForzar_clave(Request $request, $id){
         $usuario = \App\User::find($id); 
        return view('backend.usuario.forzar_clave')
                        ->with([
                                'title'=>'cambiar clave',
                                'sub'=>'Cambio de clave',
                                'usuario'=>$usuario
                            ]);
    }

    public function putForzar_clave(Request $request, $id){
        $pass_new = $request['password_nueva'];
        $pass_rep = $request['password_confirmar'];
         if($pass_new != $pass_rep){
                        $request->session()->flash('alert-danger', 'Claves no coinciden!');
                        return redirect()->back(); 
                    }
        $usuario = \App\User::find($id);
        $usuario->password = bcrypt($pass_new);
        $usuario->forzar_clave = 0;
        $usuario->save();
        $request->session()->flash('success-warning', 'El cambio de clave fue con exito!');        
        return redirect()->route('backend.usuario.index');
    }


    //POST
    public function cambiando_clave(Request $request, $id){

        if(\Auth::check()){
                $pass_old = $request['password_anterior'];
                $pass_new = $request['password_nueva'];
                $pass_rep = $request['password_confirmar'];

                if(Hash::check($pass_old, \Auth::user()->password)){

                    if($pass_new != $pass_rep){
                        $request->session()->flash('alert-danger', 'Claves no coinciden!');
                        return redirect()->back(); 
                    }
                    $usuario = \Auth::user();
                    $usuario->password = bcrypt($pass_new);
                    $usuario->forzar_clave = 1;
                    $usuario->save();
                    return redirect()->route('backend.dashboard');
                
                }else{
                    $request->session()->flash('alert-danger', 'Clave antigua no existe!');
                    return redirect()->back();   
                }
        }else{
            abort(403);
        }

    }

    public function ordenDireccion($valor){
        
        if ($valor['activa'] ==0){
            return $valor['order_date'];
        }else{
            return  $valor['order_date']=='asc'?'desc':'asc';
        }
    }
}
