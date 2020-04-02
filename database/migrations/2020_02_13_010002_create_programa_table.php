<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaTable extends Migration {

   public function up(){
      Schema::create('programa', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('descripcion', 255);
         $table->unsignedBigInteger('nivel_acad_id')->nullable(); // Tipo programa fk
         $table->unsignedBigInteger('programa_id')->nullable(); // Programa fk

         $table->foreign('nivel_acad_id')->references('id')->on('attribute')->onDelete('cascade');
         $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
      });
   }

   public function down(){
      Schema::dropIfExists('programa');
   }

}
