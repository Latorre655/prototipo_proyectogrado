<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progresos', function (Blueprint $table) {
            $table->integer('bloque_actual')->default(0)->after('total_tareas');
        });
    }

    public function down(): void
    {
        Schema::table('progresos', function (Blueprint $table) {
            $table->dropColumn('bloque_actual');
        });
    }
};