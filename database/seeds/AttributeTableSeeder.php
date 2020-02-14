<?php

use Illuminate\Database\Seeder;
use App\Attribute;

class AttributeTableSeeder extends Seeder {

	public function run(){
		$tipo_programa = [
			'Escuela profesional', 'segunda especialidad profesional',
			'Maestria', 'Doctorado'
		];
		$modalidad = ['con ciclo taller de tesis', 'sin ciclo taller de tesis'];
		$prioridad = [];  // NO ESPECIFICADO
		$linea = [];  // NO ESPECIFICADO
		$fuente_financiamiento = [
			'Autofinanciado', 'FEDU UNAC', 'Región Callao', 'Fondos concursables',
			'Otro'
		];
		$naturaleza = ['Básica', 'Aplicada'];
		$enfoque = ['Cuantitativo', 'Cualitativo', 'Mixto'];
		$corte = ['Transversal', 'Longitudinal'];
		$temporalidad = ['Prospectivo', 'Retrospectivo', 'Retroprospectivo'];
		$diseno = [
			'No experimental', 'Experimental puro', 'Pre experimental',
			'Cuasi experimental'
		];
		$nivel = [
			'Aplicativo',
			'Predictivo',
			'Explicativo',
			'Relacional',
			'Comparativo',
			'Descriptivo',
			'Exploratorio'
		];
		$poblacion = [
			'200 a más',
			'100 a 199',
			'60 a 99',
			'30 a 59',
			'menos de 30',
			'Otros'
		];
		$muestra = [
			'No aplica (población < 30)',
			'Trabajó con toda la población',
			'200 a más',
			'100 a 199',
			'60 a 99',
			'30 a 59',
			'menos de 30',
			'Otros'
		];
		$unidad_analisis = [
			'Registros (documentos)',
			'Pacientes / usuarios',
			'Familiares de pacientes',
			'Familias',
			'Personal del Salud',
			'Docentes universitarios',
			'Docentes Institutos',
			'Docentes Academias',
			'Docentes EBR',
			'Estudiantes universitarios',
			'Estudiantes Institutos',
			'Estudiantes Academias',
			'Estudiantes EBR secundaria',
			'Estudiantes EBR primaria',
			'Estudiantes EBR inicial',
			'Madres',
			'Cuidadores',
			'Niños (no escolares)',
			'Otros'
		];
		$area_estudio = [
			'Hospital MINSA',
			'Hospital ESSALUD',
			'Clínicas',
			'Policlínicos - EPS particulares',
			'Instituciones Educativas',
			'Universidades',
			'Establecimientos de Salud de Atención Primaria',
			'Empresas',
			'Comunidad',
			'Otros',
		];
		$producto = [
			'Tesis pregrado',
			'Tesis posgrado',
			'Artículo',
			'Patente',
			'Otros'
		];
		$condicion_autor = [
			'Investigador principal',
			'Docente colaborador ',
			'Personal administrativo',
			'Estudiantes de apoyo'
		];


		$types = [  // Attribute types
			$tipo_programa, $modalidad, $prioridad, $linea, $fuente_financiamiento,
			$naturaleza, $enfoque, $corte, $temporalidad, $diseno, $nivel,
			$poblacion, $muestra, $unidad_analisis, $area_estudio, $producto,
			$condicion_autor
		];

		// Walk all types fields
		for($i=0; $i<count($types); $i++){ // Walk types
			foreach($types[$i] as $t){ // Walk each type fields
				$temp = new Attribute; // New attribute register
				$temp->type = $i+1; // Set type
				$temp->descripcion = $t; // Set descripcion
				$temp->save();
				unset($temp); // Unset variable $temp
			}
		}

	}
}
