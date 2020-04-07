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
         $table->unsignedBigInteger('nivel_acad_id'); // Programa fk
         // Referencia padre a Autor (M2M)

         // Metadatos
         $table->unsignedBigInteger('modalidad_id'); // Modalidad fk
         $table->unsignedBigInteger('prioridad_id'); // Prioridad fk
         $table->unsignedBigInteger('linea_id'); // Linea fk
         $table->float('presupuesto');
         $table->unsignedBigInteger('fuente_financiamiento_id')->nullable(); // FuenteFinanciamiento fk
         $table->string('fuente_financiamiento_otro')->nullable();

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
         $table->unsignedBigInteger('poblacion_id')->nullable(); // Poblacion fk
         $table->char('poblacion_otro')->nullable();
         $table->unsignedBigInteger('muestra_id')->nullable(); // Muestra fk
         $table->string('muestra_otro')->nullable();
         $table->string('unidad_analisis')->nullable(); // UnidadAnalisis fk
         $table->string('unidad_analisis_otro')->nullable();

         // Lugar de estudio
         $table->string('ubigeo_id'); // Ubigeo fk
         $table->unsignedBigInteger('area_estudio_id')->nullable(); // AreaEstudio fk
         $table->string('area_estudio_otro')->nullable();

         // Relacionado al documento
         $table->longText('resumen')->nullable();
         $table->longText('objetivos')->nullable();
         $table->unsignedBigInteger('producto_id'); // Producto fk
         $table->string('producto_otro')->nullable(); 
         $table->text('url')->nullable();
         /* Nota:
            los campos de llave foranea que pueden contener valores 'otro',
            tienen un registro nulo que será seleccionado cuando se tenga que especificar el campo otros
         */
         $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
         $table->foreign('nivel_acad_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('modalidad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('prioridad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('linea_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('fuente_financiamiento_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('naturaleza_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('enfoque_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('corte_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('temporalidad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('diseno_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('nivel_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('poblacion_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('muestra_id')->references('id')->on('attribute')->onDelete('cascade');
         
         $table->foreign('ubigeo_id')->references('id')->on('ubigeo')->onDelete('cascade');
         $table->foreign('area_estudio_id')->references('id')->on('attribute')->onDelete('cascade');

         $table->foreign('producto_id')->references('id')->on('attribute')->onDelete('cascade');
      });
   }

   public function down(){
      Schema::dropIfExists('informe');
   }

}
