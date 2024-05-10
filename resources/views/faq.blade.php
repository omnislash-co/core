<x-app-layout title="Frequently Asked Questions">

    <div class="section container measure">
        <div class="dialog" aria-labelledby="dialog-title">
            <header class="dialog__header">
                <h1 class="h3" id="dialog-title">Frequently Asked Questions</h1>
            </header>
            <div class="dialog__body">
                <div class="content">
                    <h4 class="color-accent">What is Omnislash?</h4>
                    <p>
                        Omnislash is a platform that allows users to discover, track, review, recommend and discuss JRPG video games.
                    </p>

                    <h4 class="color-accent">Which games are added?</h4>
                    <p>
                        The primary focus is on JRPGs, role-playing games from Japan-based developers. Though games that are inspired by JRPGs and are very highly rated, such as <em>Chained Echoes</em>, may be added to the database (this is a very low priority).
                    </p>

                    <h4 class="color-accent">How are games consolidated?</h4>
                    <p>
                        The following guidelines are used when consolidating games.
                        <div class="alert bg-warning-soft text-sm">
                            <p>
                                These guidelines are not set in stone and may change in the future. If you would like to provide some feedback regarding this process, please let us know via the <a href="{{ route('waterhole.home') }}">community forums</a> in the "ideas" channel!
                            </p>
                        </div>
                    </p>
                    <p>
                        <h6>Shared Pages</h6>
                        <ul>
                            <li>Multiplatform games</li>
                            <li>
                                Ports/Remasters<br>
                                <em class="text-xs color-muted">Example: Xenoblade Chronicles (Nintendo Wii) will be grouped together with Xenoblade Chronicles 3D (New Nintendo 3DS).</em>
                            </li>
                        </ul>
                    </p>

                    <p>
                        <h6>Seperate Pages</h6>
                        <ul>
                            <li>Remakes<br>
                                <em class="text-xs color-muted">Examples: Super Mario RPG (Switch), Final Fantasy III (Nintendo DS)</em>
                            </li>
                            <li>Ports/Remasters that add new content (story, gameplay changes etc.)<br>
                                <em class="text-xs color-muted">Example: Xenoblade Chronicles: Definitive Edition</em>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
