<!DOCTYPE html>
<html lang="en">

@include('backend.layout.head')

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="index.html" class="brand-wrap">
                <img src="{{ asset('assets/imgs/theme/logo.svg') }}" class="logo" alt="Nest Dashboard" />
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
            </div>
        </div>
       @include('backend.layout.sidebar')
    </aside>
    <main class="main-wrap">
        @include('backend.layout.header')
        @yield('content')
        @include('backend.layout.footer')
    </main>
    @include('backend.layout.js')
</body>

</html>
