<?php

use Illuminate\Database\Seeder;
use App\Ajuste;
class AjustesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ajustes = app(\App\Http\Controllers\AjustesController::class);
      	$ajustes = $ajustes->data();  // Get attributes from DB

		foreach($ajustes as $a){ 
				$temp = new Ajuste; 
				$temp->nombre = $a['nombre']; 
				$temp->valor = $a['valor']; 
				$temp->descripcion = $a['descripcion'];
				$temp->tipo = $a['tipo']; 
				$temp->save();
				unset($temp); 
			}
    }
}
