<x-app-layout title="Series">

    <div class="section container">
        <section class="stack gap-gutter">
            <h2>Series</h2>

            <section class="with-sidebar">
                <nav class="sidebar stack gap-gutter">
                	<div class="card p-md stack gap-xs">
                		<div>
                			<h3 class="nav-heading">Most Games</h3>
                		</div>
                        @foreach ($seriesByGamesCount as $entry)
                            <div class="row">
                                <div class="oswald-stencil color-accent p-xs text-center" style="width: 40px">
                                    {{ $loop->iteration }}
                                </div>
                                <a class="menu-item text-xs" href="{{ route('series.show', $entry->slug) }}">
                                    <div class="full-width">
                                        <div class="menu-item__title">
                                            {{ $entry->name }}
                                        </div>
                                        <div class="menu-item__description">
                                            <div class="weight-medium">
                                                {{ $entry->games_count }} games
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                	</div>

                	<div class="card p-md stack gap-xs">
                		<div>
                			<h3 class="nav-heading">Most Popular</h3>
                		</div>
                        @foreach ($seriesByGamesCount as $entry)
                            <div class="row">
                                <div class="oswald-stencil color-accent p-xs text-center" style="width: 40px">
                                    {{ $loop->iteration }}
                                </div>
                                <a class="menu-item text-xs" href="{{ route('series.show', $entry->slug) }}">
                                    <div class="full-width">
                                        <div class="menu-item__title">
                                            {{ $entry->name }}
                                        </div>
                                        <div class="menu-item__description">
                                            <div class="weight-medium">
                                                {{ $entry->games_count }} users
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                	</div>
                </nav>

                <div>
			        <div class="card p-sm text-xs">
			            <div class="row">
			                <div class="p-sm weight-bold" style="flex: 5">Title</div>
			                <div class="p-sm weight-bold text-center" style="flex: 1">Games</div>
			            </div>
			            @foreach ($series as $entry)
				            <div class="row align-center list-entry">
				            	<div class="p-sm" style="flex: 5">
				            		<a href="{{ route('series.show', $entry->slug) }}">{{ $entry->name }}</a>
				            	</div>
	                    		<div class="p-sm text-center" style="flex: 1">
	                    			{{ $entry->games_count }}
	                    		</div>
				            </div>
			            @endforeach
			        </div>
                </div>
			</section>

        </section>
    </div>

</x-app-layout>