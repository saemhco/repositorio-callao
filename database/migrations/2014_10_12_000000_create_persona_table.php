<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration{

   public function up(){
      Schema::create('persona', function(Blueprint $table){
         $table->char('dni', 8);
         $table->string('nombres');
         $table->string('apellidos');
         $table->char('codigo', 11)->nullable();  // Longitud exacta del código - ¿no son 10?
         $table->boolean('genero');  // True:Male False:Female

         $table->primary('dni');
      });
   }
   public function down(){
      Schema::dropIfExists('persona');
   }
}
