<?php

use Tonysm\ImportmapLaravel\Facades\Importmap;

Importmap::pinAllFrom('resources/js', to: 'js/');
Importmap::pin("@hotwired/turbo", to: "/js/vendor/@hotwired--turbo.js"); // @hotwired/turbo@8.0.13 downloaded from https://ga.jspm.io/npm:@hotwired/turbo@8.0.13/dist/turbo.es2017-esm.js
Importmap::pin("laravel-echo", to: "/js/vendor/laravel-echo.js"); // laravel-echo@2.1.6 downloaded from https://ga.jspm.io/npm:laravel-echo@2.1.6/dist/echo.js
Importmap::pin("pusher-js", to: "/js/vendor/pusher-js.js"); // pusher-js@8.4.0 downloaded from https://ga.jspm.io/npm:pusher-js@8.4.0/dist/web/pusher.js
Importmap::pin("@hotwired/stimulus", to: "/js/vendor/@hotwired--stimulus.js"); // @hotwired/stimulus@3.2.2 downloaded from https://ga.jspm.io/npm:@hotwired/stimulus@3.2.2/dist/stimulus.js
Importmap::pin("@hotwired/stimulus-loading", to: "vendor/stimulus-laravel/stimulus-loading.js", preload: true);