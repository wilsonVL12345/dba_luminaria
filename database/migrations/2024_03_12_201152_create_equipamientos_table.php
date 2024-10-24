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
        Schema::create('equipamientos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Item', 150);
            $table->text('Descripcion');
            $table->string('estado', 50);

            $table->unsignedBigInteger(column: 'Distritos_id');
            $table->foreign(columns: 'Distritos_id')->references(columns: 'id')
                ->on(table: 'distritos')->onDelete(action: 'cascade');

            $table->softDeletes();
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamientos');
    }
};
