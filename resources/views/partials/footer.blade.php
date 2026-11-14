<footer id="footer" class="footer">
    <div class="bg-fill" style="border-top: 1px solid var(--color-fill); border-bottom: 1px solid var(--color-fill); height: 10px;">
    </div>
    <div class="section" style="border-bottom: 1px solid var(--color-fill);">
        <nav class="container row grow justify-between wrap">
            <div class="stack gap-sm">
                <div class="row gap-xs">
                    <a href="{{ route('home') }}">
                        <span class="oswald-stencil" style="font-size: 25px;">Omnislash</span>
                    </a>
                    <span class="weight-medium">
                        &copy; {{ now()->year }} 
                    </span>
                </div>
                <div>
                    <a href="{{ route('games.index') }}">Games</a> &#9642;
                    <a href="{{ route('waterhole.home') }}">Community</a> &#9642;
                    <a href="{{ route('reviews.index') }}">Reviews</a> &#9642;
                    <a href="{{ route('reviews.index') }}">Recommendations</a> &#9642;
                    <a href="{{ route('faq') }}">FAQ</a>
                </div>
            </div>
            <div>
                <img src="{{ url('images/layout/rabite.gif') }}" role="img" alt="rabite" />
            </div>
        </nav>
    </div>
</footer>