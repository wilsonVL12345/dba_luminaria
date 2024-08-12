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
        Schema::create('luminarias', function (Blueprint $table) {
            $table->id();
            $table->string('Modelo', 40);
            $table->string('Marca', 40);
            $table->string('Potencia', 40);
            $table->string('Cod_Luminaria', 50)->nullable()->unique();
            $table->string('Lugar_Instalado', 40)->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();



            $table->unsignedBigInteger(column: 'Proyectos_id');
            $table->foreign(columns: 'Proyectos_id')->references(columns: 'id')
                ->on(table: 'proyectos');

            $table->unsignedBigInteger(column: 'Detalles_id');
            $table->foreign(columns: 'Detalles_id')->references(columns: 'id')
                ->on(table: 'detalles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luminarias');
    }
};
