<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GameController;

class UpdateRanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-ranks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the popularity and score ranks for games';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        GameController::updateRankings();
    }
}
