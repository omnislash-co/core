<x-app-layout title="Series">

    <div class="section container">
        <section class="stack gap-gutter">
            <h2>Series</h2>

            <div>
				<ul class="card" role="list">
		            @foreach ($series as $entry)
	            		<li class="card__row">
	                		<a href="{{ route('series.show', $entry->slug) }}">{{ $entry->name }}</a> ({{ $entry->games_count }})
	            		</li>
		            @endforeach
				</ul>
				<div style="margin-top: var(--space-md)">
	            	{{ $series->links() }}
	            </div>
            </div>

        </section>
    </div>

</x-app-layout>