<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\empresaRequest;

class empresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title;
    private $ruta_logo;


    public function __construct(){
        $this->title = "gestionar empresa";
        $this->ruta_logo = "";

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.empresa.create')->with([
                'title'=> $this->title,
                'sub'=>"crear empresa"
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(empresaRequest $request)
    {
     

        if($request->file('ruta_logo')){
            $file = $request->file('ruta_logo');
            $this->ruta_logo = 'log_empresa_'.time()."". \Auth::user()->id .'.'.$file->getClientOriginalExtension();

            $path = public_path() . '/imagenes/empresa/';
            $file->move($path,$this->ruta_logo);
            
        }
        $empresa = new \App\Empresa($request->all());
        $empresa->ruta_logo = $this->ruta_logo;
        $empresa->save();



        return redirect()->route('backend.dashboard');
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
    public function destroy($id)
    {
        //
    }
}
