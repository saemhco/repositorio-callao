<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{

   public function up(){
      Schema::create('users', function (Blueprint $table) {
         $table->char('dni', 8);
         $table->string('nombres');
         $table->string('apellidos');
         $table->char('sexo', 1);
         $table->string('password');
         $table->rememberToken();
         $table->timestamps();

         $table->primary('dni');
      });
   }

   public function down(){
      Schema::dropIfExists('users');
   }
}
