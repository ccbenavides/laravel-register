<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth:tablero'],function(){	
	Route::get('backend/dashboard',[
			'as'=>'backend.dashboard',
			'uses'=>'mainController@index']);	
});

Route::group(['middleware'=>'auth:permiso_usuario'],function(){
	Route::resource('backend/trabajador','trabajadorController');
	Route::resource('backend/usuario','usuarioController');
	Route::get('backend/usuario/forzar_clave/{id}',[
			'as'=>'backend.usuario.forzar_clave',
			'uses'=>'usuarioController@getForzar_clave'
		]);
	Route::put('backend/usuario/forzar_clave/{id}',[
			'as'=>'backend.usuario.forzar_clave',
			'uses'=>'usuarioController@putForzar_clave'
		]);
});


Route::group(['middleware'=>'auth:permiso_albun'],function(){
	Route::resource('backend/galeria','galeriaController');	
	Route::resource('backend/galeria_categoria','galeriaCategoriaController');
	Route::get('backend/foto/{id}',[
			'as'=>'backend.galeria.agregarFotos',
			'uses'=>'galeriaController@agregarFotos'
		]);

	Route::get('backend/foto/eliminar/{id}',[
			'as'=>'backend.galeria.eliminarFoto',
			'uses'=>'galeriaController@eliminarFoto'
		]);

	Route::post('backend/foto',[
			'as'=>'backend.galeria.guardarFotos',
			'uses'=>'galeriaController@guardarFotos'
		]);
});



Route::group(['middleware'=>'auth:permiso_sitio'],function(){
	Route::resource('backend/empresa','empresaController');
});

Route::group(['middleware'=>'auth:permiso_publicacion'],function(){
	Route::resource('backend/blog','publicacionController');
	Route::resource('backend/blog_categoria','blogCategoriaController');
});

Route::group(['middleware'=>'auth:permiso_producto'],function(){
	Route::resource('backend/catalogo_categoria','catologoCategoriaController');
	Route::resource('backend/subcategoria_producto','productoSubController');
	Route::resource('backend/producto','productoController');
});


Route::get('backend/auth/login',
		['uses'=>'Auth\AuthController@getLogin',
		   'as'=>'auth.login']);

Route::post('backend/auth/login',
	   ['uses'=>'Auth\AuthController@postLogin',
	      'as'=>'auth.login']);

Route::get('backend/auth/logout',
		[ 'uses'=>'Auth\AuthController@getLogout',
			'as'=>'auth.logout']);

Route::put('backend/usuario/cambiando_clave/{id}',[
			'as'=>'backend.usuario.cambiando_clave',
			'uses'=>'usuarioController@cambiando_clave'
		]);