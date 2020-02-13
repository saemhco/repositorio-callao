<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicionAutorTable extends Migration {

   public function up(){
      Schema::create('condicion_autor', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('descripcion');
      });
   }

   public function down(){
      Schema::dropIfExists('condicion_autor');
   }

}
