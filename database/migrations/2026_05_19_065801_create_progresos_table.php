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
        Schema::create('progresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('modulo_id');
            $table->boolean('completado')->default(false);
            $table->integer('tareas_completadas')->default(0);
            $table->integer('total_tareas')->default(0);
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_completado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progresos');
    }
};
