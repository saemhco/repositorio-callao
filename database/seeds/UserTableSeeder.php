<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin',
                'nombres' => 'Saúl Angel',
                'apellidos' => 'Escandón Munguía',
                'password' => bcrypt('12345678'),
                'rol' => '0',
            ]
         ]);
        DB::table('users')->insert([
            [
                'username' => 'Administrador',
                'nombres' => 'MERCEDES LULILEA',
                'apellidos' => 'FERRER MEJIA',
                'email' => 'mlferrerm@unac.edu.pe',
                'password' => bcrypt('12345678'),
                'rol' => '0'
            ]
         ]);
        // DB::table('rsu_ejes')->insert([
        //     [
        //         'eje' => 'Proyección Social',
        //         'abr' => 'PS',
        //     ],  [
        //         'eje' => 'Extensión Cultural',
        //         'abr' => 'EC',
        //     ],  [
        //         'eje' => 'Mixto (Proyección Social y Extensión cultural)',
        //         'abr' => 'MA',
        //     ],
        //  ]);


        DB::table('persona')->insert([
            [
                'dni'       => '12345678',
                'apellidos' => 'FERRER MEJIA',
                'nombres'   => 'MERCEDES LULILEA',
                'genero'    => false,

            ]
         ]);
    }
}
