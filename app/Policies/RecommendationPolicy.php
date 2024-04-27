<?php

namespace App\Policies;

use App\Recommendation;
use Illuminate\Auth\Access\Response;
use Waterhole\Models\User;

class RecommendationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Recommendation $recommendation): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Recommendation $recommendation): bool
    {
        return $user->id === $recommendation->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Recommendation $recommendation): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Recommendation $recommendation): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Recommendation $recommendation): bool
    {
        //
    }
}
