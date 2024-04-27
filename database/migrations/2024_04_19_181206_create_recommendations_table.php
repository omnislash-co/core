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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('game_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('platform_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('played_game_id')->constrained('games')->cascadeOnUpdate();
            $table->text('body');
            $table->timestamps();

            $table->unique(['user_id', 'game_id', 'played_game_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
