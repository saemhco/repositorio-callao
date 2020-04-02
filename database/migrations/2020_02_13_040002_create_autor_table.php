<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorTable extends Migration {

   public function up(){
      Schema::create('autor', function(Blueprint $table){
         $table->increments('id');
         $table->char('persona_id',8);  // Persona fk
         $table->unsignedBigInteger('informe_id');  // Informe fk
         $table->unsignedBigInteger('condicion_id');  // Condicion fk

         $table->foreign('persona_id')->references('dni')->on('persona')->onDelete('cascade');
         $table->foreign('informe_id')->references('id')->on('informe')->onDelete('cascade');
         $table->foreign('condicion_id')->references('id')->on('attribute')->onDelete('cascade');
      });
   }
#   Tabla autor (persona_id,informe_id,condicion)

   public function down(){
      Schema::dropIfExists('autor');
   }

}
