<?php

namespace App\Providers;

use Waterhole\Extend;
use Illuminate\Support\Facades\Route;
use Waterhole\View\Components\NavLink;
use Waterhole\View\Components\NavHeading;
use Waterhole\Models\User;

use Waterhole\View\Components\HeaderGuest;
use Waterhole\View\Components\HeaderModeration;
use Waterhole\View\Components\HeaderNotifications;
use Waterhole\View\Components\HeaderUser;
use Waterhole\View\Components\ThemeSelector;

class WaterholeServiceProvider extends Extend\ServiceProvider
{
    public function register(): void
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

        $this->extend(function (Extend\Assets\Stylesheet $stylesheet) {
            $stylesheet->add(resource_path('css/waterhole/app.css'));
        });

        $this->extend(function (Extend\Ui\DocumentHead $documentHead) {
            $documentHead->add('waterhole.head');
        });

        $this->extend(function (Extend\Ui\Layout $layout) {
            $layout->header->replace('title', 'waterhole.title');
            $layout->header->remove('breadcrumb');
            $layout->header->remove('search');

            $layout->header->remove('theme');
            $layout->header->remove('moderation');
            $layout->header->remove('notifications');
            $layout->header->remove('guest');
            $layout->header->remove('user');

            $layout->header->add('waterhole.header-search');
            $layout->header->add(ThemeSelector::class, 'theme');
            $layout->header->add(HeaderModeration::class, 'moderation');
            $layout->header->add(HeaderNotifications::class, 'notifications');
            $layout->header->add(HeaderGuest::class, 'guest');
            $layout->header->add(HeaderUser::class, 'user');


            $layout->after->add('partials.footer');
        });

        $this->extend(function (Extend\Ui\UserNav $userNav) {
            $userNav->add(
                fn(User $user) => new NavLink(
                    label: 'Library',
                    icon: 'tabler-device-gamepad',
                    badge: \App\User::withCount('libraries')->find($user->id)->libraries_count,
                    href: route('users.libraryIndex', compact('user')),
                    active: request()->routeIs('users.library'),
                ),
                'library',
                -1
            );

            $userNav->add(
                fn(User $user) => new NavLink(
                    label: 'Favourites',
                    icon: 'tabler-heart',
                    badge: \App\User::withCount('favorites')->find($user->id)->favorites_count,
                    href: route('users.favourites', compact('user')),
                    active: request()->routeIs('users.favourites'),
                ),
                'favourites',
                -1
            );

            $userNav->add(
                fn(User $user) => new NavLink(
                    label: 'Reviews',
                    icon: 'tabler-note',
                    badge: \App\User::withCount('reviews')->find($user->id)->reviews_count,
                    href: route('users.reviews', compact('user')),
                    active: request()->routeIs('users.reviews'),
                ),
                'reviews',
                -1
            );

            $userNav->add(
                fn(User $user) => new NavLink(
                    label: 'Recommendations',
                    icon: 'tabler-thumb-up',
                    badge: \App\User::withCount('recommendations')->find($user->id)->recommendations_count,
                    href: route('users.recommendations', compact('user')),
                    active: request()->routeIs('users.recommendations'),
                ),
                'recommendations',
                -1
            );

            $userNav->add(
                new NavHeading('Community'),
                'community',
                -1
            );
        });
    }
}
