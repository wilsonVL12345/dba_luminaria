<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Paterno', 50);
            $table->string('Materno', 50)->nullable();
            $table->integer('Ci');
            $table->string('Expedido');
            $table->integer('Celular');
            $table->string('Genero', 10);
            $table->string('Cargo', 20);
            $table->string('Lugar_Designado', 25);
            $table->string('Estado', 20);
            $table->string('perfil')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
