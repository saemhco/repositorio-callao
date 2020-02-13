<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorTable extends Migration {

   public function up(){
      Schema::create('autor', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('alumno', 8)->nullable(); // Alumno fk
         $table->char('docente', 8)->nullable(); // Docente fk
         $table->unsignedBigInteger('informe_id'); // Informe fk
         $table->unsignedBigInteger('condicion_id'); // Condicion fk
         $table->char('genero', 1); // Male: 1, Female: 2

         $table->foreign('alumno')->references('codigo')->on('alumno')->onDelete('cascade');
         $table->foreign('docente')->references('codigo')->on('docente')->onDelete('cascade');
         $table->foreign('informe_id')->references('id')->on('informe')->onDelete('cascade');
         $table->foreign('condicion_id')->references('id')->on('condicion_autor')->onDelete('cascade');
      });
   }

   public function down(){
      Schema::dropIfExists('autor');
   }

}
