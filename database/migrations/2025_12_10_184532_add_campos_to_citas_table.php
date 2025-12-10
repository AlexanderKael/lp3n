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
            $table->string('placa_vehiculo')->nullable()->after('servicio');
            $table->text('descripcion')->nullable()->after('placa_vehiculo');
        });
    }

    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn(['placa_vehiculo', 'descripcion']);
        });
    }
};
