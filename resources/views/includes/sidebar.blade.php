<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu d-flex flex-column">
        <div class="nav flex-grow-1">
            <div class="sb-sidenav-menu-heading">Pages</div>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="/blog">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Blog
            </a>
            <a class="nav-link" href="/users">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Users
            </a>
        </div>
        <div class="sb-sidenav-footer mt-auto">
            <div class="small">Logged in as:</div>
            @guest
                {{ 'Guest' }}
            @endguest
            @auth
                {{ auth()->user()->name }}
            @endauth
        </div>
    </div>
</nav>
