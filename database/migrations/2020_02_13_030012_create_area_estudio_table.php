<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaEstudioTable extends Migration {

   public function up(){
      Schema::create('area_estudio', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('descripcion', 255);
      });
   }

   public function down(){
      Schema::dropIfExists('area_estudio');
   }

}
