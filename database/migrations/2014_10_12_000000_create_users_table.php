<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
   public function up(){
      Schema::create('users', function(Blueprint $table){
         $table->increments('id');
         $table->string('username');
         $table->string('nombres');
         $table->string('apellidos');
         $table->string('password');
         $table->string('email')->nullable();
         $table->string('foto')->default('user.png');
         $table->string('rol')->default('1'); //0:admin,1=reg,2=otro
         $table->rememberToken();
         $table->timestamps();
      });

   }

   public function down(){
      Schema::dropIfExists('users');
   }
}
