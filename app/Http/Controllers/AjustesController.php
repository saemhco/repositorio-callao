<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Ajuste;
use DB;
class AjustesController extends Controller
{	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
    	$ajustes=Ajuste::get();
    	return view('ajustes.index',compact('ajustes'));
    }
    public function update(Request $r){
    	$query=[];
    	//texto
    	for ($i=1; $i < 4; $i++) {
    		$valor='elemento_'.$i;
    		$query[$i] = DB::table('ajustes')->where('id', $i)->update(['valor' => $r->$valor]);
    	}

    	for ($i=4; $i < 9; $i++) { 
    		$valor='elemento_'.$i;
    		
    		if($r->file($valor)){
    			$archivo_actual=Ajuste::find($i);
	            //Eliminamos el imagen que existía
	            Storage::delete($archivo_actual->valor);
	            $name= $r->file($valor)->store('public/ajustes/img');
	            $query[$i] = DB::table('ajustes')->where('id', $i)->update(['valor' => $name]);
        	}
    	}
    	
    	return redirect()->route('ajustes.index');
    }

    public function restablecer(){
    	$ajustes = $this->data();
    	$query=[];
    	foreach ($ajustes as $key => $value) {
    		$query[$key+1] = DB::table('ajustes')->where('id', ($key+1))->update(['valor' => $value['valor']]);
    	}
    	Storage::deleteDirectory('public/ajustes/img');
    	return redirect()->route('ajustes.index');

    }

    public function data(){
    	return [
			['nombre'=>'título','valor'=>'Repositorio Callao','descripcion'=>'Aparecerá en el título del proyecto','tipo'=>'texto'],
			['nombre'=>'pie pagina 1','valor'=>'Copyright © 2020 REPOSITORIO Callao, Todos los derechos Reservados. Universidad Nacional del Callao','descripcion'=>'texto grande','tipo'=>'texto'],
			['nombre'=>'pie pagina 2','valor'=>' Desarrollado por saem','descripcion'=>'texto pequeño','tipo'=>'texto'],
			['nombre'=>'icono','valor'=>'material-pro/assets/images/icono.ico','descripcion'=>'Ícono del proyecto','tipo'=>'imagen'],
			['nombre'=>'logo','valor'=>'material-pro/assets/images/logo.png', 'descripcion'=>'Logo principal, símbolo','tipo'=>'imagen'],
			['nombre'=>'logo texto 1','valor'=>'material-pro/assets/images/logo-light-text.png','descripcion'=>'Logo de texto claro','tipo'=>'imagen'],
			['nombre'=>'logo texto 2','valor'=>'material-pro/assets/images/logo-text.png','descripcion'=>'Logo de texto oscuro, login','tipo'=>'imagen'],
			['nombre'=>'imagen fondo login','valor'=>'material-pro/assets/images/background/login.jpg','descripcion'=>'Imagen de fondo en la vista login','tipo'=>'imagen'],
			['nombre'=>'manual usuario','valor'=>'https://drive.google.com/file/d/1L2xqNMehmsjKHMut9OgpSISm6M9cAW9p/view?usp=sharing','descripcion'=>'Manual de usuario','tipo'=>'archivo_ruta'],
			['nombre'=>'manual administrador','valor'=>'https://drive.google.com/file/d/16vrreNnNt2C6KCJsmmTdhU6IN8R2grvF/view?usp=sharing','descripcion'=>'Manual de uso para el administrador','tipo'=>'archivo_ruta'],
			['nombre'=>'video tutorial usuario','valor'=>'https://www.youtube.com/watch?v=uuFItBGQx04&pbjreload=10','descripcion'=>'Video tutorial para usuario','tipo'=>'archivo_ruta'],
			['nombre'=>'video tutorial administrador','valor'=>'https://www.youtube.com/watch?v=uuFItBGQx04&pbjreload=10','descripcion'=>'Video tutorial para el administrador','tipo'=>'archivo_ruta'],
		];
    }
}
