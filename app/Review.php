<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'summary', 'body', 'score', 'user_id', 'game_id', 'platform_id'
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
     * The user this review belongs to.
     *
     */
    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    /**
     * The game this review belongs to.
     *
     */
    public function game(): BelongsTo
    {
      return $this->belongsTo(Game::class);
    }

    /**
     * The platform this review belongs to.
     *
     */
    public function platform(): BelongsTo
    {
      return $this->belongsTo(Platform::class);
    }
}
