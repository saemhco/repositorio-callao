<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder {
    public function run(){
        $this->call([
            UserTableSeeder::class,
            AttributeTableSeeder::class,
            ProgramaTableSeeder::class,
            UbigeoTableSeeder::class
        ]);
    }
}
