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
        Schema::create('game_relations', function (Blueprint $table) {
            $table->foreignId('parent_game_id')->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('child_game_id')->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('relation_type_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->primary(['parent_game_id', 'child_game_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_relations');
    }
};
