<?php

namespace App\Policies;

use App\Library;
use App\Replay;
use Illuminate\Auth\Access\Response;
use Waterhole\Models\User;

class ReplayPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Replay $replay): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Library $library): bool
    {
        return $user->id === $library->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Replay $replay): bool
    {
        return $user->id === $replay->library->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Replay $replay): bool
    {
        return $user->id === $replay->library->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Replay $replay): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Replay $replay): bool
    {
        return false;
    }
}
