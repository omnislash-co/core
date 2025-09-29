<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Coderflex\Laravisit\Concerns\HasVisits;
use Coderflex\Laravisit\Concerns\CanVisit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
            ->using(GameRelations::class);
    }

    /**
     * Determine if user has a library entry for this game.
     */
    public function hasUserPlayed(): bool
    {
        $hasUserPlayed = false;

        if (auth()->check())
        {
            $hasUserPlayed = Library::where([
                'game_id' => $this->id,
                'user_id' => auth()->user()->id,
            ])->count() > 0 ? true : false;
        }

        return (bool) $hasUserPlayed;
    }

    /**
     * Determine if user has favorited this game. 
     * Note: Built-in Overtrue\LaravelFavorite methods don't work because auth()->user() returns a Waterhole User object
     */
    public function hasUserFavorited(): bool
    {
        $hasUserFavorited = false;

        if (auth()->check())
        {
            $hasUserFavorited = User::find(auth()->user()->id)->hasFavorited($this);
        }

        return (bool) $hasUserFavorited;
    }

    public function getReleasesGroupedByPlatform()
    {
        return $this->load([
            'platforms' => fn ($query) => $query->with([
                'releases' => fn ($q) => $q->with('region')->where('game_id', $this->id)
            ])->get(),
        ]);
    } 

    protected function reviewsCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->reviews()->count(),
        )->shouldCache();
    }
    
    protected function recommendationsCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->recommendations()->count(),
        )->shouldCache();
    }

    protected function releasesCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->releases()->count(),
        )->shouldCache();
    }

    protected function seriesCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->series()->count(),
        )->shouldCache();
    }

    protected function childrenCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->children()->count(),
        )->shouldCache();
    }

    protected function parentsCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->parents()->count(),
        )->shouldCache();
    }

    /**
     * Update game rankings.
     */
    public static function updateRankings()
    {
        //Update score for all games
        Game::chunk(100, function ($games) {
            foreach ($games as $game) {
                $filtered = $game->libraries()->whereNotNull('score');
                $score = ($filtered->count() > 0 ? number_format(($filtered->avg('score') / 10) * 100, 0) : null);

                $game->update(['score' => $score]);
            }
        });

        //Update library_count for all games
        Game::withCount(['libraries' => function (Builder $query) {
                $query->select(DB::raw('count(distinct(user_id))'));
            }])->chunk(100, function ($games) {
            foreach ($games as $game) {
                $game->update(['library_count' => $game->libraries_count]);
            }
        });

        //Update score_rank for all games
        $scoreRank = 0;
        Game::orderBy('score', 'desc')->chunk(100, function ($games) use (&$scoreRank) {
            foreach ($games as $game) {
                $scoreRank++;
                $game->update(['score_rank' => $scoreRank]);
            }
        });

        //Update popularity_rank for all games
        $popularityRank = 0;
        Game::orderBy('library_count', 'desc')->chunk(100, function ($games) use (&$popularityRank) {
            foreach ($games as $game) {
                $popularityRank++;
                $game->update(['popularity_rank' => $popularityRank]);
            }
        });
    }
}
