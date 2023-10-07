<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('dist/img/avatar.png') }}" class="user-image img-circle elevation-2 alt="User Image">
                <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{ url('admin/profile') }}"><i class="fas fa-user mr-2"></i> Profile</a>
                @if (getUser()->role == 1)
                    <a class="dropdown-item" href="{{ url('admin/setting') }}"><i class="fas fa-cog mr-2"></i>
                        Setting</a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </a>
            </div>
            <form action="{{ url('logout') }}" id="form-logout">
                @csrf
            </form>
        </li>
    </ul>
</nav>
