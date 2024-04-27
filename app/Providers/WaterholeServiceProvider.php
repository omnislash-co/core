<?php

namespace App\Providers;

use Waterhole\Extend;
use Illuminate\Support\Facades\Route;
use Waterhole\View\Components\NavLink;
use Waterhole\View\Components\NavHeading;
use Waterhole\Models\User;

class WaterholeServiceProvider extends Extend\ServiceProvider
{
    public function extend(): void
    {
        /*
        |-----------------------------------------------------------------------
        | Waterhole Extenders
        |-----------------------------------------------------------------------
        |
        | The main mechanism by which you'll hook into Waterhole is with
        | extenders. There are dozens more extenders like this covering all
        | parts of Waterhole's views and functionality, ready to hook into.
        |
        | Learn more: https://waterhole.dev/docs/extending
        |
        */

        Extend\Stylesheet::add(resource_path('css/waterhole/app.css'));
        Extend\DocumentHead::add('waterhole.head');
        Extend\Header::replace('title', 'waterhole.title');

        Extend\Header::remove('breadcrumb');
        Extend\Header::remove('search');
        Extend\Header::add('waterhole.header-search');
        Extend\LayoutAfter::add('components.footer');

        Extend\UserNav::add(
            fn(User $user) => new NavLink(
                label: 'Favourites',
                icon: 'tabler-heart',
                badge: \App\User::withCount('favorites')->find($user->id)->favorites_count,
                href: route('users.favourites', compact('user')),
                active: request()->routeIs('users.favourites'),
            ),
            -1,
            'favourites');

        Extend\UserNav::add(
            fn(User $user) => new NavLink(
                label: 'Library',
                icon: 'tabler-device-gamepad',
                badge: \App\User::withCount('libraries')->find($user->id)->libraries_count,
                href: route('users.libraryIndex', compact('user')),
                active: request()->routeIs('users.library'),
            ),
            -1,
            'library');

        Extend\UserNav::add(
            fn(User $user) => new NavLink(
                label: 'Reviews',
                icon: 'tabler-note',
                badge: \App\User::withCount('reviews')->find($user->id)->reviews_count,
                href: route('users.reviews', compact('user')),
                active: request()->routeIs('users.reviews'),
            ),
            -1,
            'reviews');

        Extend\UserNav::add(
            fn(User $user) => new NavLink(
                label: 'Recommendations',
                icon: 'tabler-thumb-up',
                badge: \App\User::withCount('recommendations')->find($user->id)->recommendations_count,
                href: route('users.recommendations', compact('user')),
                active: request()->routeIs('users.recommendations'),
            ),
            -1,
            'recommendations');

        Extend\UserNav::add(
            new NavHeading('Community'),
            -1,
            'community',
        );

        // Review form
        // Extend\TextEditor::remove('mention');
        // Extend\TextEditor::remove('attachment');

        // Extend\TextEditor::remove('mention', fn() => Route::is('reviews.create') ? null : null);
        // Extend\TextEditor::remove(fn() => Route::is('reviews.create') ? 'mention' : '');
        // Extend\TextEditor::replace('attachment', fn() => Route::is('reviews.create') ? null : null);


    }
}
