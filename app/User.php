<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Overtrue\LaravelFavorite\Traits\Favoriter;

class User extends \Waterhole\Models\User
{
    use HasFactory, Favoriter;

    /**
     * The library entries this user has.
     */
    public function libraries()
    {
        return $this->hasMany(Library::class);
    }

    /**
     * The reviews this user has.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * The recommendations this user has.
     */
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
