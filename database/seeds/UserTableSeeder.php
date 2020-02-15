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
                'dni' => '12345678',
                'nombres' => 'Administrador',
                'apellidos' => 'ap',
                'sexo'=>'1',
                'rol' => '0',
                'password' => bcrypt('12345678')

            ]
         ]);
    }
}
