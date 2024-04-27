<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'acronym'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];

    /**
     * The games for this platform.
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    /**
     * The releases for this platform.
     */
    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }
}
