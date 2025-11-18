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
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->time('horario_disponible_inicio')->nullable()->after('taller_id');
            $table->time('horario_disponible_fin')->nullable()->after('horario_disponible_inicio');
            $table->string('dias_disponibles')->nullable()->after('horario_disponible_fin');
        });
    }

    public function down(): void
    {
        Schema::table('tecnicos', function (Blueprint $table) {
            $table->dropColumn(['horario_disponible_inicio', 'horario_disponible_fin', 'dias_disponibles']);
        });
    }
};
