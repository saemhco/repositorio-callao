<?php

use Illuminate\Database\Seeder;
use App\Attribute;

class ProgramaTableSeeder extends Seeder {

	public function run(){
		$tipo_programa = [
			'ESCUELA'
		];

		// Walk all types fields
		for($i=0; $i<count($types); $i++){ // Walk types
			$temp = new Attribute; // New attribute register
			$temp->type = $i+1; // Set type
			$temp->descripcion = $t; // Set descripcion
			$temp->save();
			unset($temp); // Unset variable $temp
		}

	}
}
