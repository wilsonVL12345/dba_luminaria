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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('Cuce_Cod')->unique();
            $table->string('Zona')->nullable();
            $table->string('Tipo_Contratacion', 200)->nullable();
            $table->text('Estado')->nullable();
            $table->string('Subasta', 200)->nullable();
            $table->string('Modalidad')->nullable();
            $table->string('Objeto_Contratacion')->nullable();
            $table->string('Tipo_Componentes')->nullable();
            $table->string('Ejecutado_Por')->nullable();
            $table->date('Fecha_Programada')->nullable();
            $table->date('Fecha_Ejecutada')->nullable();
            $table->text('Observaciones')->nullable();
            $table->integer('Realizado_Por')->nullable();
            $table->string('Proveedor')->nullable();


            $table->unsignedBigInteger(column: 'Users_id');
            $table->foreign(columns: 'Users_id')->references(columns: 'id')
                ->on(table: 'users');

            $table->unsignedBigInteger(column: 'Distritos_id');
            $table->foreign(columns: 'Distritos_id')->references(columns: 'id')
                ->on(table: 'distritos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
