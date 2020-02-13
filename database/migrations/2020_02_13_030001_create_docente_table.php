<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocenteTable extends Migration {

   public function up(){
      Schema::create('docente', function(Blueprint $table){
         $table->char('codigo', 12);
         $table->char('nombres', 25);
         $table->char('apellidos', 25);
         $table->unsignedBigInteger('programa_id'); // Programa fk

         $table->primary('codigo'); // Primary Key
         $table->foreign('programa_id')->references('id')->on('programa')->onDelete('cascade');
      });
   }

   public function down(){
      Schema::dropIfExists('docente');
   }

}
