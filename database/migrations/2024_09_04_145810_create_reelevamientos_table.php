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
        Schema::create('reelevamientos', function (Blueprint $table) {
            $table->id();
            $table->string('Av_calles')->nullable();
            $table->date('Fecha')->nullable();
            $table->text('Descripcion')->nullable();
            $table->string('Archivos')->unique();

            $table->unsignedBigInteger(column: 'Urbanizacion_id');
            $table->foreign(columns: 'Urbanizacion_id')->references(columns: 'id')
                ->on(table: 'urbanizacions');
            $table->unsignedBigInteger(column: 'Distritos_id');
            $table->foreign(columns: 'Distritos_id')->references(columns: 'id')
                ->on(table: 'distritos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reelevamientos');
    }
};
