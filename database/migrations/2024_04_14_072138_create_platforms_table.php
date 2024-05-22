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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('acronym')->unique()->nullable();
            $table->timestamps();
        });

        Schema::create('game_platform', function(Blueprint $table)
        {
            $table->foreignId('game_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('platform_id')->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_platform');
        Schema::dropIfExists('platforms');
    }
};
