<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeTable extends Migration {

   public function up(){
      Schema::create('attribute', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('type', 2);
         $table->char('descripcion', 255);

         /* TIPOS
            tipo_programa, modalidad, prioridad, linea, fuente_financiamiento,
            naturaleza, enfoque, corte, temporalidad, diseño, nivel, poblacion,
            muestra, unidad_analisis, area_estudio, producto, condicion_autor
         */
      });
   }

   public function down(){
      Schema::dropIfExists('attribute');
   }

}
