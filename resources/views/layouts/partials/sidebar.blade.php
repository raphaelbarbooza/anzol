<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/images/logo-white.png')}}" alt="" />
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow" href="{{route('home')}}">
                    <i class="far fa-cubes me-2"></i>  Dashboard
                </a>

            </li>

            <li class="nav-item mt-5">
                <a class="nav-link has-arrow" href="/register">
                    <i class="far fa-user-alien me-2"></i>  Nova Conta
                </a>

            </li>
        </ul>

    </div>
</nav>
