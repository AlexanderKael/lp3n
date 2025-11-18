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
        Schema::table('talleres', function (Blueprint $table) {
            $table->time('hora_apertura')->nullable()->after('email');
            $table->time('hora_cierre')->nullable()->after('hora_apertura');
            $table->string('dias_atencion')->nullable()->after('hora_cierre');
        });
    }

    public function down(): void
    {
        Schema::table('talleres', function (Blueprint $table) {
            $table->dropColumn(['hora_apertura', 'hora_cierre', 'dias_atencion']);
        });
    }
};
