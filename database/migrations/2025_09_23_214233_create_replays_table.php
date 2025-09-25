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
        Schema::create('replays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('hours')->unsigned()->nullable();
            $table->integer('hours_optional')->unsigned()->nullable();
            $table->integer('hours_complete')->unsigned()->nullable();
            $table->text('notes')->nullable();
            $table->date('started_on')->nullable();
            $table->date('finished_on')->nullable();
            $table->timestamps();
        });

        Schema::table('libraries', function (Blueprint $table) {
            $table->integer('hours_optional')->unsigned()->nullable();
            $table->integer('hours_complete')->unsigned()->nullable();
            $table->date('started_on')->nullable();
            $table->date('finished_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replays');

        Schema::table('libraries', function (Blueprint $table) {
            $table->dropColumn([
                'hours_optional', 
                'hours_complete',
                'started_on',
                'finished_on'
            ]);
        });
    }
};
