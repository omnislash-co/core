<?php

namespace App\Policies;

use App\Recommendation;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Waterhole\Models\User;

class RecommendationPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Recommendation $recommendation): bool
    {
        return $user->id === $recommendation->user_id;
    }
}
