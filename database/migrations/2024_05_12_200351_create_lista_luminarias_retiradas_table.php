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
        Schema::create('lista_luminarias_retiradas', function (Blueprint $table) {
            $table->bigIncrements('id'); // Columna autoincrementable y clave primaria
            $table->string('Nombre', 50);
            $table->integer('Cantidad');

            $table->integer('Reutilizables')->nullable();
            $table->integer('NoReutilizables')->nullable();
            $table->string('Observaciones')->nullable()->default('Ninguno');

            $table->unsignedBigInteger(column: 'datos_luminaria_id');
            $table->foreign(columns: 'datos_luminaria_id')->references(columns: 'id')
                ->on(table: 'datos_luminaria_retiradas');    //onDelete(action:'cascada'); si en caso se elimina algo en la tabla padre, se eliminara todo referido a esa fila

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_luminarias_retiradas');
    }
};
