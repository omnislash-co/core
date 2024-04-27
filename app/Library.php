<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Library extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'game_id', 'platform_id', 'play_status_id', 'score', 'hours', 'notes'
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
     * The user this library entry belongs to.
     *
     */
    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    /**
     * The game this library entry belongs to.
     *
     */
    public function game(): BelongsTo
    {
      return $this->belongsTo(Game::class);
    }

    /**
     * The platform this library entry belongs to.
     *
     */
    public function platform(): BelongsTo
    {
      return $this->belongsTo(Platform::class);
    }

    /**
     * The play status this library entry belongs to.
     *
     */
    public function playStatus(): BelongsTo
    {
      return $this->belongsTo(PlayStatus::class);
    }
}
