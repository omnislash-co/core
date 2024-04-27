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
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('platform_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('region_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('date_type_id')->constrained()->cascadeOnUpdate();
            $table->date('date')->nullable();
            $table->string('alternate_title')->nullable();
            $table->timestamps();

            $table->unique(['game_id', 'platform_id', 'region_id', 'alternate_title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};
