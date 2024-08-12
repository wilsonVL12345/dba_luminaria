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
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->id();
            $table->string('Nro_Sisco', 20)->unique();
            $table->string('ZonaUrbanizacion');
            $table->string('Tipo_Inspeccion', 20)->nullable();
            $table->string('Estado', 20)->nullable();
            $table->date('Fecha_Inspeccion')->nullable();
            $table->text('Foto_Carta')->nullable();
            $table->string('Inspeccion', 50)->nullable();
            $table->string('Detalles', 200)->nullable();
            $table->string('Inspector', 100)->nullable();
            $table->unsignedBigInteger(column: 'users_id');
            $table->foreign(columns: 'users_id')->references(columns: 'id')
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
        Schema::dropIfExists('inspecciones');
    }
};
