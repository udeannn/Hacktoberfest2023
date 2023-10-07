<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-bold text-white">{{ $setting?->application_name ?? 'SimplePos' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('') }}dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (getUser()->role == 1)
                    <li class="nav-item">
                        <a href="{{ url('admin/category') }}"
                            class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Category
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/product') }}"
                            class="nav-link {{ request()->is('admin/product') || request()->is('admin/product/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Product
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/user') }}"
                            class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/customer') }}"
                        class="nav-link {{ request()->is('admin/customer') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/order') }}"
                        class="nav-link {{ request()->is('admin/order') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                @if (getUser()->role == 1)
                    <li class="nav-item">
                        <a href="{{ url('admin/report') }}"
                            class="nav-link {{ request()->is('admin/report') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Report (Coming soon)
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
