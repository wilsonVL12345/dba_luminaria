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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->string('Nro_Sisco')->unique();
            $table->string('Zona')->nullable();
            $table->string('Tipo_Trabajo', 50);
            $table->text('Foto_Carta')->nullable();
            $table->integer('Puntos')->nullable();
            $table->date('Fecha_Programado');
            $table->date('Fecha_Inicio')->nullable();
            $table->string('Estado', 20)->nullable();
            $table->string('Observaciones')->nullable();
            $table->string('Detalles')->nullable();
            $table->string('EjecutadoPor')->nullable();

            $table->unsignedBigInteger(column: 'Users_id');
            $table->foreign(columns: 'Users_id')->references(columns: 'id')
                ->on(table: 'users')->onDelete(action: 'cascade');

            $table->unsignedBigInteger(column: 'Distritos_id');
            $table->foreign(columns: 'Distritos_id')->references(columns: 'id')
                ->on(table: 'distritos')->onDelete(action: 'cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles');
    }
};
