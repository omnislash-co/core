<?php

namespace App\Extend;

use Waterhole\Extend\Support\ComponentList;
use Waterhole\View\Components\HeaderModeration;
use Waterhole\View\Components\HeaderSaved;
use Waterhole\View\Components\HeaderNotifications;
use Waterhole\View\Components\HeaderGuest;
use Waterhole\View\Components\HeaderUser;

class HeaderNavigation extends ComponentList
{
    public function __construct()
    {
        $this->add(HeaderModeration::class, 'moderation')
            ->add(HeaderSaved::class, 'saved')
            ->add(HeaderNotifications::class, 'notifications')
            ->add(HeaderGuest::class, 'guest')
            ->add(HeaderUser::class, 'user');
    }
}