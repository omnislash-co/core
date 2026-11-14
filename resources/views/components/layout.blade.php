<x-waterhole::html title="{{ $title ?? '' }}">
    @include('partials.header')
    
    <main id="main" class="waterhole__main">
        {{ $slot }}
    </main>

    @include('partials.footer')
</x-waterhole::html>