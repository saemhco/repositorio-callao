<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProgramaTable extends Migration {

   public function up(){
      Schema::create('programa_tipo', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->char('descripcion', 255);
      });
   }

   public function down(){
      Schema::dropIfExists('programa_tipo');
   }

}
