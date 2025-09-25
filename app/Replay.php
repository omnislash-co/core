<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Replay extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'library_id', 'hours', 'hours_optional', 'hours_complete', 'notes', 'started_on', 'finished_on'
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
     * The library entry this belongs to.
     *
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }
}
