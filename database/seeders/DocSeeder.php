<?php

namespace Database\Seeders;

use App\Models\ProProceso;
use App\Models\TipTipoDoc;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       ProProceso::create([
           'pro_nombre' => 'Ingenieria',
           'pro_prefijo' => 'ING'
       ]);
        ProProceso::create([
           'pro_nombre' => 'Medicina',
           'pro_prefijo' => 'MED'
       ]);

        ProProceso::create([
           'pro_nombre'=> 'Desarrollo',
           'pro_prefijo' => 'DES'
       ]);

        ProProceso::create([
           'pro_nombre'=> 'Derecho',
           'pro_prefijo' => 'DER'
       ]);
        ProProceso::create([
            'pro_nombre'=> 'Aviacion',
            'pro_prefijo' => 'AVI'
       ]);

        TipTipoDoc::create([

            'tip_nombre'=> 'Instructivo',
            'tip_prefijo' => 'INS'
        ]);

        TipTipoDoc::create([

            'tip_nombre'=> 'Formato',
            'tip_prefijo' => 'FOR'
        ]);

        TipTipoDoc::create([

            'tip_nombre'=> 'Procedimiento',
            'tip_prefijo' => 'PRO'
        ]);

        TipTipoDoc::create([

            'tip_nombre'=> 'Protocolo',
            'tip_prefijo' => 'PCL'
        ]);

        TipTipoDoc::create([

            'tip_nombre'=> 'Manual',
            'tip_prefijo' => 'MAN'
        ]);

        User::create([
            'name'              => 'Administrador',
            'email'             => 'admin@email.com',
            'password'          =>  Hash::make('1234567890')
        ]);


    }
}
