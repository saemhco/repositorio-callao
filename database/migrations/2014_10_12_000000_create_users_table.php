<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->char('dni', 8);
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->char('sexo', 1);
            $table->string('password');
            $table->string('rol')->default('2'); //0:admin,1=reg,2=otro
            $table->rememberToken();
            $table->timestamps();
        }
   }

   public function down(){
      Schema::dropIfExists('users');
   }
}
