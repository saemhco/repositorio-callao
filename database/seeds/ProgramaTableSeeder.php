<?php

use Illuminate\Database\Seeder;
use App\Programa;

class ProgramaTableSeeder extends Seeder {

	public function run(){
		$tipo_programa = [
			'ESCUELA'
		];

		$facultades = [
				'Ciencias de la Salud',
				'Ciencias Administrativas',
				'Ciencias Contables',
				'Ciencias Económicas',
				'Ingeniería Eléctrica y Electrónica',
				'Ingeniería Industrial y Sistemas',
				'Ingeniería Mecánica y Energía',
				'Ingeniería Pesquera y Alimentos',
				'Ingeniería Química',
				'Ciencias Naturales y Matemáticas',
				'Ingeniería Ambiental y Recursos Naturales'
		];
		$ep =[
				['facultad'=>'1','tipo'=>'1','descripcion'=>'Enfermería'],
				['facultad'=>'1','tipo'=>'1','descripcion'=>'Educación Física'],
				['facultad'=>'2','tipo'=>'1','descripcion'=>'Administración'],
				['facultad'=>'3','tipo'=>'1','descripcion'=>'Contabilidad'],
				['facultad'=>'4','tipo'=>'1','descripcion'=>'Economía'],
				['facultad'=>'5','tipo'=>'1','descripcion'=>'Ingeniería Eléctrica'],
				['facultad'=>'5','tipo'=>'1','descripcion'=>'Ingeniería Electrónica'],
				['facultad'=>'6','tipo'=>'1','descripcion'=>'Ingeniería Industrial'],
				['facultad'=>'6','tipo'=>'1','descripcion'=>'Ingeniería Sistemas'],
				['facultad'=>'7','tipo'=>'1','descripcion'=>'Ingeniería Mecánica'],
				['facultad'=>'7','tipo'=>'1','descripcion'=>'Ingeniería en Energía'],
				['facultad'=>'8','tipo'=>'1','descripcion'=>'Ingeniería de Alimentos'],
				['facultad'=>'8','tipo'=>'1','descripcion'=>'Ingeniería Pesquera'],
				['facultad'=>'9','tipo'=>'1','descripcion'=>'Ingeniería Química'],
				['facultad'=>'10','tipo'=>'1','descripcion'=>'Física'],
				['facultad'=>'10','tipo'=>'1','descripcion'=>'Matemática'],
				['facultad'=>'11','tipo'=>'1','descripcion'=>'Ingeniería Ambiental y Recursos Naturales'],
		];

		$seg_esp_prof=[
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Administración en Salud'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Centro Quirúrgico'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Cuidados Quirúrgicos'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Emergencia y Desastres'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Gerontología y Geriatría'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Oncología'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Salud Mental'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Salud Pública y Comunitaria'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Salud del Niño y Adolescente'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería Intensiva'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería Pediátrica'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Epidemiología'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Crecimiento, Desarrollo del Niño y Estimulación de la Primera Infancia'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Salud Familiar y Comunitaria'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Enfermería en Neonatología'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Política y Gestión de Salud en Enfermería'],
				['facultad'=>'1','tipo'=>'2','descripcion'=>'Educación Física con Mención en Actividad Física para la Salud'],
		];
		$maestria=[
				['facultad'=>'1','tipo'=>'3','descripcion'=>'Enfermería'],
				['facultad'=>'1','tipo'=>'3','descripcion'=>'Enfermería Familiar y Comunitaria'],
				['facultad'=>'1','tipo'=>'3','descripcion'=>'Gerencia en Salud'],
				['facultad'=>'1','tipo'=>'3','descripcion'=>'Salud Pública'],
				['facultad'=>'1','tipo'=>'3','descripcion'=>'Salud Ocupacional y Ambiental'],
				['facultad'=>'1','tipo'=>'3','descripcion'=>'Ciencias de la Salud'],
				['facultad'=>'2','tipo'=>'3','descripcion'=>'Administración Estratégica de Empresas'],
				['facultad'=>'2','tipo'=>'3','descripcion'=>'Gerencia Educativa'],
				['facultad'=>'2','tipo'=>'3','descripcion'=>'Administración Marítima y Portuaria'],
				['facultad'=>'3','tipo'=>'3','descripcion'=>'Tributación'],
				['facultad'=>'3','tipo'=>'3','descripcion'=>'Ciencias Fiscalizadoras con Mención en Auditoría Gubernamental'],
				['facultad'=>'3','tipo'=>'3','descripcion'=>'Ciencias Fiscalizadoras con Mención en Auditoría Integral Empresarial'],
				['facultad'=>'4','tipo'=>'3','descripcion'=>'Comercio y Negociaciones Internacionales'],
				['facultad'=>'4','tipo'=>'3','descripcion'=>'Finanzas'],
				['facultad'=>'4','tipo'=>'3','descripcion'=>'Investigación y Docencia Universitaria'],
				['facultad'=>'4','tipo'=>'3','descripcion'=>'Proyectos de Inversión'],
				['facultad'=>'5','tipo'=>'3','descripcion'=>'Ciencias de la Electrónica con Mención en Control y Automatización'],
				['facultad'=>'5','tipo'=>'3','descripcion'=>'Ingeniería Eléctrica con Mención en Gestión de Sistemas de Energía Eléctrica'],
				['facultad'=>'5','tipo'=>'3','descripcion'=>'Ingeniería Eléctrica con Mención en Gerencia de Proyectos de Ingeniería'],
				['facultad'=>'5','tipo'=>'3','descripcion'=>'Ciencias de la Electrónica con Mención en Telecomunicaciones'],
				['facultad'=>'5','tipo'=>'3','descripcion'=>'Ciencias de la Electrónica con Mención en Ingeniería Biomédica'],
				['facultad'=>'6','tipo'=>'3','descripcion'=>'Ingeniería Industrial con Mención en Gerencia en Logística'],
				['facultad'=>'6','tipo'=>'3','descripcion'=>'Ingeniería Industrial con Mención en  Gerencia de la Calidad y Productividad'],
				['facultad'=>'6','tipo'=>'3','descripcion'=>'Ingeniería de Sistemas'],
				['facultad'=>'6','tipo'=>'3','descripcion'=>'Productividad y Relaciones Industriales'],
				['facultad'=>'7','tipo'=>'3','descripcion'=>'Gerencia del Mantenimiento'],
				['facultad'=>'8','tipo'=>'3','descripcion'=>'Gestión Pesquera'],
				['facultad'=>'8','tipo'=>'3','descripcion'=>'Ingeniería de Alimentos'],
				['facultad'=>'9','tipo'=>'3','descripcion'=>'Gerencia de la Calidad y Desarrollo Humano'],
				['facultad'=>'9','tipo'=>'3','descripcion'=>'Ciencia y Tecnología de Alimentos'],
				['facultad'=>'9','tipo'=>'3','descripcion'=>'Ingeniería Química'],
				['facultad'=>'10','tipo'=>'3','descripcion'=>'Didáctica de la Enseñanza de la Física y Matemática'],
				['facultad'=>'11','tipo'=>'3','descripcion'=>'Gestión Ambiental para el Desarrollo Sostenible'],
		]; 
		$doctorado=[
				['facultad'=>'1','tipo'=>'4','descripcion'=>'Enfermería'],
				['facultad'=>'1','tipo'=>'4','descripcion'=>'Ciencias de la Salud'],
				['facultad'=>'1','tipo'=>'4','descripcion'=>'Educación'],
				['facultad'=>'1','tipo'=>'4','descripcion'=>'Salud Pública'],
				['facultad'=>'1','tipo'=>'4','descripcion'=>'Administración en Salud'],
				['facultad'=>'2','tipo'=>'4','descripcion'=>'Administración'],
				['facultad'=>'3','tipo'=>'4','descripcion'=>'Ciencias Contables'],
				['facultad'=>'5','tipo'=>'4','descripcion'=>'Ingeniería Eléctrica'],
		];

		$programas=[$ep,$seg_esp_prof,$maestria,$doctorado];

		foreach ($facultades as $key => $f){
				$temp = new Programa;
				$temp->descripcion = $f;
				$temp->save();
				unset($temp); // Unset variable $temp
		}

		// Walk all programas fields
		for($i=0; $i<count($programas); $i++){ // Walk types
			foreach ($programas[$i] as $key => $programa){
				$temp = new Programa;
				$temp->descripcion = $programa['descripcion'];
				$temp->nivel_acad_id = $programa['tipo'];
				$temp->programa_id = $programa['facultad'];
				$temp->save();
				unset($temp); // Unset variable $temp
			}
		}

	}
}
