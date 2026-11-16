<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
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
        'title', 'slug', 'description', 'icon', 'cover', 'initial_release_year', 'score', 'library_count', 'score_rank', 'popularity_rank'
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
        return $this->belongsToMany(Developer::class)->orderBy('name');
    }

    /**
     * The genres for this game.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)->orderBy('name');
    }

    /**
     * The platforms for this game.
     */
    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class)->orderBy('name');
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

    /**
     * The series for this game.
     */
    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Series::class)->orderBy('name');
    }

    /**
     * The parent games for this game.
     */
    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_relations', 'child_game_id', 'parent_game_id')
            ->withPivot(['relation_type_id'])
            ->using(GameRelations::class);
    }

    /**
     * The child games for this game.
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_relations', 'parent_game_id', 'child_game_id')
            ->withPivot(['relation_type_id'])
            ->using(GameRelations::class)
            ->join('relation_types', 'game_relations.relation_type_id', '=', 'relation_types.id')
            ->orderBy('relation_types.sort')
            ->select('games.*'); // prevents column collision
    }

    /**
     * Determine if user has a library entry for this game.
     */
    public function hasUserPlayed(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return $this->libraries()
            ->where('user_id', auth()->id())
            ->exists();
    }

    /**
     * Determine if user has favorited this game. 
     * Note: Built-in Overtrue\LaravelFavorite methods don't work because auth()->user() returns a Waterhole User object
     */
    public function hasUserFavorited(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return User::find(auth()->id())?->hasFavorited($this) ?? false;
    }

    /**
     * Update game rankings.
     */
    public static function updateRankings()
    {
        // 1. Update score and library_count for all games
        DB::statement("
            UPDATE games g
            LEFT JOIN (
                SELECT
                    game_id,
                    ROUND(AVG(score) * 10) AS avg_score,          -- 0-10 → 0-100
                    COUNT(DISTINCT user_id) AS lib_count
                FROM libraries
                WHERE score IS NOT NULL
                GROUP BY game_id
            ) AS stats ON stats.game_id = g.id
            SET
                g.score          = stats.avg_score,
                g.library_count  = COALESCE(stats.lib_count, 0)
        ");

        // 2. Update score_rank for all games
        DB::statement("
            UPDATE games g
            JOIN (
                SELECT
                    id,
                    ROW_NUMBER() OVER (ORDER BY score DESC, title ASC) AS rnk
                FROM games
            ) ranked ON ranked.id = g.id
            SET g.score_rank = ranked.rnk
        ");

        // 3. Update popularity_rank for all games
        DB::statement("
            UPDATE games g
            JOIN (
                SELECT
                    id,
                    ROW_NUMBER() OVER (ORDER BY library_count DESC, title ASC) AS rnk
                FROM games
            ) ranked ON ranked.id = g.id
            SET g.popularity_rank = ranked.rnk
        ");
    }
}
