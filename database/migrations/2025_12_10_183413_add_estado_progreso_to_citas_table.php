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
        Schema::table('citas', function (Blueprint $table) {
            $table->string('estado_progreso')->default('pendiente')->after('estado');
        });
    }

    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn('estado_progreso');
        });
    }
};
