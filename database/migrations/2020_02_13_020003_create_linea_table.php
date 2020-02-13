<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaTable extends Migration {

   public function up(){
      Schema::create('linea', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('descripcion', 255);
      });
   }

   public function down(){
      Schema::dropIfExists('linea');
   }

}
