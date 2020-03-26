<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbigeoTable extends Migration {

   public function up(){
      Schema::create('ubigeo', function(Blueprint $table){
         // $table->bigIncrements('id');
         // $table->char('ubigeo', 8); // Ubigeo
         // $table->char('descripcion', 255); // Nombre
            $table->char('id',6);
            $table->char('type', 2);
            $table->string('descripcion');
            $table->string('prov_id',4)->nullable();
            $table->string('dep_id',2)->nullable();
            $table->primary('id');
      });
   }

   public function down(){
      Schema::dropIfExists('ubigeo');
   }

}
