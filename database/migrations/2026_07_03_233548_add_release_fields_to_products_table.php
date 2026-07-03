<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('release_notes')->nullable()->after('is_active');
            $table->date('release_date')->nullable()->after('release_notes');
            $table->foreignId('user_id')->nullable()->after('release_date')->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['release_notes', 'release_date', 'user_id']);
        });
    }
};
