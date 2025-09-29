<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameRelations extends Pivot
{
    /**
     * The relation type
     *
     */
    public function relationType(): BelongsTo
    {
      return $this->belongsTo(RelationType::class);
    }
}
