<x-waterhole::user-profile :user="$user" :title="$title">

    <div class="stack gap-lg">
        <nav aria-label="library-tabs">
            <div class="tabs" role="list">
                <a href="{{ route('users.library', ['playStatus' => 'currently-playing', 'user' => $user->id]) }}" 
                    @class(['tab', 'is-active' => Route::isWith('users.library', ['playStatus' => 'currently-playing', 'user' => $user->id])])>Currently Playing</a>
            
                <a href="{{ route('users.library', ['playStatus' => 'completed', 'user' => $user->id]) }}" 
                    @class(['tab', 'is-active' => Route::isWith('users.library', ['playStatus' => 'completed', 'user' => $user->id])])>Completed</a>
                    
                <a href="{{ route('users.library', ['playStatus' => 'planning', 'user' => $user->id]) }}" 
                    @class(['tab', 'is-active' => Route::isWith('users.library', ['playStatus' => 'planning', 'user' => $user->id])])>Planning</a>
            
                <a href="{{ route('users.library', ['playStatus' => 'on-hold', 'user' => $user->id]) }}" 
                    @class(['tab', 'is-active' => Route::isWith('users.library', ['playStatus' => 'on-hold', 'user' => $user->id])])>On Hold</a>
            
                <a href="{{ route('users.library', ['playStatus' => 'dropped', 'user' => $user->id]) }}" 
                    @class(['tab', 'is-active' => Route::isWith('users.library', ['playStatus' => 'dropped', 'user' => $user->id])])>Dropped</a>
            </div>
        </nav>

        {{ $slot }}
    </div>

</x-waterhole::user-profile>