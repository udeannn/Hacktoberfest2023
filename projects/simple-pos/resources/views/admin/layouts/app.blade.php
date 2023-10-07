<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('admin.layouts._head')
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="loader-wrapper preload">
        <div class="loader"></div>
    </div>
    <div class="wrapper">

        <!-- Navbar -->
        @include('admin.layouts._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layouts._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">

                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('admin.layouts._footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('admin.layouts._scripts')
    @stack('scripts')
</body>

</html>
