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
                        Omnislash is a platform that allows users to discover, track, review, recommend and discuss JRPG style video games.
                    </p>

                    <h4 class="color-accent">How are games consolidated?</h4>
                    <p>
                        On some gaming websites, games generally have their own page/section even if it's the same game just on different platforms. In order to consolidate pages such as these, the following guidelines are used when adding games to the database.
                        <blockquote>
                            These guidelines are not set in stone and may change in the future. If you would like to provide some feedback regarding this process, please let us know via the <a href="{{ route('waterhole.home') }}">community forums</a> in the "ideas" channel!
                        </blockquote>
                    </p>
                    <p>
                        <h6>Shared Pages</h6>
                        <ul>
                            <li>Multiplatform games</li>
                            <li>
                                Ports/Remasters<br>
                                <em class="text-xs">Example: Xenoblade Chronicles (Nintendo Wii) will be grouped together with Xenoblade Chronicles 3D (New Nintendo 3DS).</em>
                            </li>
                        </ul>
                    </p>

                    <p>
                        <h6>Seperate Pages</h6>
                        <ul>
                            <li>Remakes<br>
                                <em class="text-xs">Examples: Super Mario RPG (Switch), Final Fantasy III (Nintendo DS)</em>
                            </li>
                            <li>Ports/Remasters that add new content (story, features etc.)<br>
                                <em class="text-xs">Example: Xenoblade Chronicles: Definitive Edition</em>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
