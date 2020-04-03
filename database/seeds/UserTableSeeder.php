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
                'username' => 'Administrador',
                'nombres' => 'Saúl Angel',
                'apellidos' => 'Escandón Munguía',
                'password' => bcrypt('12345678'),
                'rol' => '0'
            ]
         ]);

        DB::table('persona')->insert([
            [
                'dni'       => '12345678',
                'apellidos' => 'Paterno Materno',
                'nombres'   => 'Nombre1 Nombre2',
                'codigo'    => '12345678901',
                'genero'    => true,

            ]
         ]);
    }
}
