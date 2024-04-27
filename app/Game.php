<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Coderflex\Laravisit\Concerns\HasVisits;
use Coderflex\Laravisit\Concerns\CanVisit;

class Game extends Model implements CanVisit
{
    use HasFactory, Favoriteable, HasVisits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'slug', 'description', 'icon', 'initial_release_year', 'score', 'library_count', 'score_rank', 'popularity_rank'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * The developers for this game.
     */
    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class);
    }

    /**
     * The genres for this game.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * The platforms for this game.
     */
    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class);
    }

    /**
     * Get all of the reviews for this game.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all of the reviews for this game.
     */
    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class, 'played_game_id');
    }

    /**
     * Get all of the releases for this game.
     */
    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    /**
     * The library entries for this game.
     */
    public function libraries()
    {
        return $this->hasMany(Library::class);
    }
}
