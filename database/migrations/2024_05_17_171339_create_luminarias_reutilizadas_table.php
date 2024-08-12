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
        Schema::create('luminarias_reutilizadas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Item');
            $table->integer('Cantidad');
            $table->integer('Disponibles')->nullable();
            $table->integer('Utilizados')->nullable();
            $table->string('Observaciones')->nullable();

            $table->unsignedBigInteger(column: 'Proyectos_id');
            $table->foreign(columns: 'Proyectos_id')->references(columns: 'id')
                ->on(table: 'proyectos');    //onDelete(action:'cascada'); si en caso se elimina algo en la tabla padre, se eliminara todo referido a esa fila



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luminarias_reutilizadas');
    }
};
