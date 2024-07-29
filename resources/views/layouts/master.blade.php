<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
</head>

<body class="sb-nav-fixed">
    @include('includes.navbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('includes.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('includes.footer')
        </div>
    </div>
    @include('includes.scripts')
</body>

</html>
