<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Release extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id', 'platform_id', 'region_id', 'date_type_id', 'date', 'alternate_title'
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
     * The game this release belongs to.
     *
     */
    public function game(): BelongsTo
    {
      return $this->belongsTo(Game::class);
    }

    /**
     * The platform this release belongs to.
     *
     */
    public function platform(): BelongsTo
    {
      return $this->belongsTo(Platform::class);
    }

    /**
     * The region this release belongs to.
     *
     */
    public function region(): BelongsTo
    {
      return $this->belongsTo(Region::class);
    }

    /**
     * The date type this release belongs to.
     *
     */
    public function dateType(): BelongsTo
    {
      return $this->belongsTo(DateType::class);
    }
}
