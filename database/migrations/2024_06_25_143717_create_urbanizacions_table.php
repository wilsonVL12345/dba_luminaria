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
        Schema::create('urbanizacions', function (Blueprint $table) {
            $table->id();
            $table->integer('Nrodistrito');
            $table->string('nombre_urbanizacion');
            $table->text('lng')->nullable();
            $table->text('lat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urbanizacions');
    }
};
