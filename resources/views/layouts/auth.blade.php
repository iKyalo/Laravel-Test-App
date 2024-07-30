<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
</head>

<body class="bg-secondary">
    @include('includes.alerts')

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                @yield('content')
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            @include('includes.footer')
        </div>
    </div>
    @include('includes.scripts')
</body>

</html>
