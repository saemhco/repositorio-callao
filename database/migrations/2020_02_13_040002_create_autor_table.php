<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorTable extends Migration {

   public function up(){
      Schema::create('autor', function(Blueprint $table){
         $table->unsignedBigInteger('persona_id');  // Persona fk
         $table->unsignedBigInteger('informe_id');  // Informe fk
         $table->unsignedBigInteger('condicion_id');  // Condicion fk

         $table->primary('persona_id');  // Primary Key
         $table->foreign('informe_id')->references('id')->on('informe')->onDelete('cascade');
         $table->foreign('condicion_id')->references('id')->on('attribute')->onDelete('cascade');
      });
   }
#   Tabla autor (persona_id,informe_id,condicion)

   public function down(){
      Schema::dropIfExists('autor');
   }

}
