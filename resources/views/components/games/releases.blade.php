@props(['game'])

<div class="stack gap-gutter">
    @if ($game->releases_count > 0)
        @foreach ($game->platforms as $platform)
            @if (count($platform->releases) > 0)

                <div class="stack gap-md">
                    <h3>{{ $platform->name }}</h3>
                    <div class="table-container full-width" tabindex="0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Region</th>
                                    <th>Date</th>
                                    <th>Alternate Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($platform->releases as $release)
                                    <tr>
                                        <td>{{ $release->region->name }}</td>
                                        <td>{{ Carbon\Carbon::parse($release->date)->toFormattedDateString() }}</td>
                                        <td>{{ $release->alternate_title ? $release->alternate_title : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @endif
        @endforeach
    @else
        <div class="alert bg-warning-soft">
            No releases found.
        </div>
    @endif
</div>