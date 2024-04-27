<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recommendation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body', 'user_id', 'game_id', 'platform_id', 'played_game_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
      'pivot'
    ];

    /**
     * The user this recommendation belongs to.
     *
     */
    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    /**
     * The game this recommendation belongs to.
     *
     */
    public function game(): BelongsTo
    {
      return $this->belongsTo(Game::class);
    }

    /**
     * The platform this recommendation belongs to.
     *
     */
    public function platform(): BelongsTo
    {
      return $this->belongsTo(Platform::class);
    }

    /**
     * The played game this recommendation belongs to.
     *
     */
    public function playedGame(): BelongsTo
    {
      return $this->belongsTo(Game::class);
    }
}
