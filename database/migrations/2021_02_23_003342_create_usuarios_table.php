<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('career')->nullable();
            $table->enum('roles',['administrador','Profesor','Auxiliar','Estudiante']);
            $table->text('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile');
            $table->string('jobTitle');
            $table->string('skills');
            $table->string('jobSummary');
            $table->enum('permissions',['read','write','manage']);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
