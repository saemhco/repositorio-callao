<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeTable extends Migration {

   public function up(){
      Schema::create('informe', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('titulo', 255);
         $table->unsignedBigInteger('programa_id'); // Programa fk
         // Referencia padre a Autor (M2M)

         // Metadatos
         $table->unsignedBigInteger('modalidad_id'); // Modalidad fk
         $table->unsignedBigInteger('prioridad_id'); // Prioridad fk
         $table->unsignedBigInteger('linea_id'); // Linea fk
         $table->float('presupuesto');
         $table->unsignedBigInteger('fuente_financiamiento'); // FuenteFinanciamiento fk
         $table->char('fuente_financiamiento_otro')->nullable();

         // Personal relacionado
         $table->char('asesor', 8); // Asesor fk
         $table->char('jurado1', 8); // Docente fk
         $table->char('jurado2', 8); // Docente fk
         $table->char('jurado3', 8); // Docente fk
         $table->char('jurado4', 8); // Docente fk

         // Cronograma
         $table->date('fecha_sustentacion');
         $table->date('cronograma_inicio');
         $table->date('cronograma_fin');

         // Datos de la investigación
         $table->unsignedBigInteger('naturaleza_id'); // Naturaleza fk
         $table->unsignedBigInteger('enfoque_id'); // Enfoque fk
         $table->unsignedBigInteger('corte_id'); // Corte fk
         $table->unsignedBigInteger('temporalidad_id'); // Temporalidad fk
         $table->unsignedBigInteger('diseno_id'); // Diseño fk
         $table->unsignedBigInteger('nivel_id'); // Nivel fk

         // Muestra y población
         $table->unsignedBigInteger('poblacion_id'); // Poblacion fk
         $table->char('poblacion_otro')->nullable();
         $table->unsignedBigInteger('muestra_id'); // Muestra fk
         $table->char('muestra_otro')->nullable();
         $table->unsignedBigInteger('unidad_analisis_id'); // UnidadAnalisis fk
         $table->char('unidad_analisis_otro')->nullable();

         // Lugar de estudio
         $table->unsignedBigInteger('ubigeo_id'); // Ubigeo fk
         $table->unsignedBigInteger('area_estudio_id'); // AreaEstudio fk
         $table->char('area_estudio_otro')->nullable();

         // Relacionado al documento
         $table->text('resumen');
         $table->char('objetivo_general', 125);
         $table->char('objetivos_especificos', 255);
         $table->unsignedBigInteger('producto_id'); // Producto fk

         /* Nota:
            los campos de llave foranea que pueden contener valores 'otro',
            tienen un registro nulo que será seleccionado cuando se tenga que especificar el campo otros
         */
         $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');

         $table->foreign('modalidad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('prioridad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('linea_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('fuente_financiamiento')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('asesor')->references('codigo')->on('docente')->onDelete('cascade');
         $table->foreign('jurado1')->references('codigo')->on('docente')->onDelete('cascade');
         $table->foreign('jurado2')->references('codigo')->on('docente')->onDelete('cascade');
         $table->foreign('jurado3')->references('codigo')->on('docente')->onDelete('cascade');
         $table->foreign('jurado4')->references('codigo')->on('docente')->onDelete('cascade');

         $table->foreign('naturaleza_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('enfoque_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('corte_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('temporalidad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('diseno_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('nivel_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('poblacion_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('muestra_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('unidad_analisis_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('ubigeo_id')->references('id')->on('ubigeo')->onDelete('cascade');
         $table->foreign('area_estudio_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('producto_id')->references('id')->on('attribute')->onDelete('cascade');
      });
   }

   public function down(){
      Schema::dropIfExists('informe');
   }

}
