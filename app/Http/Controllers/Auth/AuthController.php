<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectPath = 'backend/dashboard';
    protected $username = 'username';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(){
        return view('backend.usuario.login');
    }

/*    public function postLogin(Request $request){
        $user = User::where('username',$request['username'])->get();
        if($user){
            dd("asdasd");
            return view('backend.dashboard');
        }else{
            Auth::logout();
        }


    }*/
    public function postLogin(Request $request){
        $credentials =[
        'username'=>$request->input('username'),
        'password'=>$request->input('password')
        ];

        if(!Auth::attempt($credentials)){
            Session::flash('flash_error','Algo fallo, revise bien sus datos');
            return redirect()->back();
        }
            
        $usuario = Auth::User();

       /* if($usuario->ultima_conexion === "0000-00-00 00:00:00"){
            Session::flash('flash_error','Welcome, Cambie su contraseña');
            return redirect()->route("backend.usuario.cambiando_clave");
        }
*/
        $usuario->ultima_conexion = date('Y-m-d H:i:s');

        $usuario->save();
        

        return redirect('backend/dashboard');
        
    }

    



}
