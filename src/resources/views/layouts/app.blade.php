<!DOCTYPE html>
    @include('settings::layouts.head')
    <body>
    <div id="app">
        @include('settings::layouts.nav')

        <main class="py-4 mt-5">
            @yield('content')
        </main>

    </div>
    </body>
</html>
