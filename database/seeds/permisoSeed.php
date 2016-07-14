<?php

use Illuminate\Database\Seeder;

class permisoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new \App\Permiso();
        $usuario->nombre = "permiso_usuario";
        $usuario->descripcion ="Permisos para Usuarios";
        $usuario->save();

        $sitio = new \App\Permiso();
        $sitio->nombre = "permiso_sitio";
        $sitio->descripcion ="Permisos para Sitio";
        $sitio->save();


        $publicacion = new \App\Permiso();
        $publicacion->nombre = "permiso_publicacion";
        $publicacion->descripcion ="Permisos para blog";
        $publicacion->save();


        $albun = new \App\Permiso();
        $albun->nombre = "permiso_albun";
        $albun->descripcion ="permisos para galeria";
        $albun->save();


        $producto = new \App\Permiso();
        $producto->nombre = "permiso_producto";
        $producto->descripcion ="permisos para productos";
        $producto->save();

        // dar permisos de administrador al primer usuario
        $usuario = \App\User::find(1);

        $usuario->permisos()->attach([1,2,3,4,5]);

    }
}
