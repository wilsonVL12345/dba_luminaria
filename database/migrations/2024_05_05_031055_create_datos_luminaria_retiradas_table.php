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
        Schema::create('datos_luminaria_retiradas', function (Blueprint $table) {
            $table->id();
            $table->string('zona');
            $table->integer('Nro_sisco')->unique();
            $table->date('Fecha');
            $table->string('Proyecto');
            $table->string('Direccion');

            $table->unsignedBigInteger(column: 'User_id');
            $table->foreign(columns: 'User_id')->references(columns: 'id')
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
        Schema::dropIfExists('datos_luminaria_retiradas');
    }
};
