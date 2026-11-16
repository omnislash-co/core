<?php

namespace App\Policies;

use App\Library;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Waterhole\Models\User;

class LibraryPolicy
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
    public function update(User $user, Library $library): bool
    {
        return $user->id === $library->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Library $library): bool
    {
        return $user->id === $library->user_id;
    }
}
