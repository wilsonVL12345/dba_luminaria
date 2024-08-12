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
        Schema::create('accesorios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'Id_Lista_accesorios');
            $table->foreign(columns: 'Id_Lista_accesorios')->references(columns: 'id')
                ->on(table: 'lista_accesorios');
            $table->integer('Cantidad')->nullable();
            $table->integer('Utilizados')->nullable();
            $table->integer('Disponibles')->nullable();


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
        Schema::dropIfExists('accesorios');
    }
};
