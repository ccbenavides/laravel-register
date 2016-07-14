<?php

use Illuminate\Database\Seeder;

class usuariosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

  	     $usuario_2 = [
                  'username'=>'ccbenavides',
         			   'password'=>bcrypt('123456')
                 ];
                 
         \App\User::create($usuario_2);


         $usuario_3 = [
                       'username'=>'isabela',
                       'password'=>bcrypt('123456')
                       ];
         \App\User::create($usuario_3);


         $usuario_4 = [
                       'username'=>'ccamila',
                       'password'=>bcrypt('123456')
                       ];

         \App\User::create($usuario_4);
         



         $cate_blog = [
                        'nombre'=>'fiesta de camila',
                        'imagen'=>'start_war.jpg',
                        'descripcion'=>'fue una fiesta que hubo bastante alcohol',
                        'estado'=>true,
                        'user_id'=>1
                        ];

        \App\CatBlog::create($cate_blog);


    }
}
