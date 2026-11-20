{{--
|--------------------------------------------------------------------------
| Document Head
|--------------------------------------------------------------------------
|
| HTML added to this template will show up in the <head> tag on every page.
| This is a great place to add any custom <link> and <meta> tags.
|
| If you're looking to add a favicon, this is a great resource:
| https://evilmartians.com/chronicles/how-to-favicon-in-2021-six-files-that-fit-most-needs
|
--}}
<link rel='icon' type='image/x-icon' href='{{ asset('images/favicons/favicon.ico') }}'>
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
<meta name="turbo-prefetch" content="false">
@fonts
@vite(['resources/js/app.js'])