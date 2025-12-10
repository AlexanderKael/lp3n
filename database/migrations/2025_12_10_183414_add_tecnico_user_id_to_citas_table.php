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
            $table->foreignId('tecnico_user_id')->nullable()->after('tecnico_id')->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['tecnico_user_id']);
            $table->dropColumn('tecnico_user_id');
        });
    }
};
