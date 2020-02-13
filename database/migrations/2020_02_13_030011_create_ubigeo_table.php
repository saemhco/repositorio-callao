<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbigeoTable extends Migration {

   public function up(){
      Schema::create('ubigeo', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('ubigeo', 8); // Ubigeo
         $table->char('descripcion', 255); // Nombre
      });
   }

   public function down(){
      Schema::dropIfExists('ubigeo');
   }

}
