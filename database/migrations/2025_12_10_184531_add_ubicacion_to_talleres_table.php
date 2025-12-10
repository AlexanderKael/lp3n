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
            $table->decimal('latitud', 10, 8)->nullable()->after('email');
            $table->decimal('longitud', 11, 8)->nullable()->after('latitud');
            $table->string('ciudad')->nullable()->after('longitud');
        });
    }

    public function down(): void
    {
        Schema::table('talleres', function (Blueprint $table) {
            $table->dropColumn(['latitud', 'longitud', 'ciudad']);
        });
    }
};
