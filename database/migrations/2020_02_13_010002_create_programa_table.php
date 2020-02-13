<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaTable extends Migration {

   public function up(){
      Schema::create('programa', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('descripcion', 255);
         $table->unsignedBigInteger('tipo_programa_id'); // Tipo programa fk
         $table->unsignedBigInteger('programa_id'); // Programa fk

         $table->foreign('tipo_programa_id')->references('id')->on('programa_tipo')->onDelete('cascade');
         $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
      });
   }

   public function down(){
      Schema::dropIfExists('programa');
   }

}
