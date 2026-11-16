<?php

namespace App\Policies;

use App\Review;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Waterhole\Models\User;

class ReviewPolicy
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
    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id;
    }
}
