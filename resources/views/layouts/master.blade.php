<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._header_scripts_main')
    @yield('stylesheets')
    @yield('header_scripts')
</head>
<body>
    <div id="container">
        <header>
            {{-- @include('partials._login_status'); --}}
            @include('partials._messages')
            @include('partials._header')
            @include('partials._navigation')
        </header>

        <main>
            <section id="home">
                @yield('content')
            </section>
        </main>

        <footer class="row">
            @include('partials._footer')
        </footer>
    </div>
    @include('partials._footer_scripts_main')
    @yield('footer_scripts')
</body>
</html>
