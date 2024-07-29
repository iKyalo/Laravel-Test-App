<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
</head>

<body>
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                @yield('content')
            </main>
        </div>
        <div id="layoutError_footer">
            @include('includes.footer')
        </div>
    </div>
    @include('includes.scripts')
</body>

</html>
