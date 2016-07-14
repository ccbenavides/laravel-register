<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(usuariosSeed::class);
         $this->call(permisoSeed::class);
        $idioma_1 = ['name'=>'español'];
        $idioma_2 = ['name'=>'ingles'];
        \App\Idioma::create($idioma_1);
        \App\Idioma::create($idioma_2);

     

        Model::reguard();
    }
}
