<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initialscale=1">
        <title>Sistem Manajemen Pengembangan Aplikasi</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="hold-transition sidebar-mini">
        
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars">&nbsp;Admin</i>
                    </a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary bg-success elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <img src=" {{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Sistem Manajemen <br>Pengembangan Aplikasi</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                    <div class="info">
                        <a href="#" class="d-block">Giovanni</a>
                    </div>
                </div> --}}
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    {{-- <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div> --}}
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('tampilanAdmin') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Dashboard</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ url('projek') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Projek</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('supervisor') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Supervisor</p>
                            </a>
                        </li>  
                        <li class="nav-item">
                            <a href="{{ route('tim.indexAdmin') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Tim</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('client.indexAdmin') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Client</p>
                            </a>
                        </li>  
                        <li class="nav-item">
                            <a href="{{ route('projek.projekSelesai') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Projek Selesai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('projek.projekBatal') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Daftar Projek Batal</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('client.chatClient') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Chat</p>
                            </a>
                        </li>                                                                    --}}
                        <li class="nav-item">
                            <a href="{{ url('') }}" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                {{-- <div class="float-right d-none d-sm-inline"> 200710835</div>
                <!-- Default to the left -->
                <strong>Copyright &copy; {{ date('Y') }} <a href="#">AdminLTE.io</a>. </strong> All rights reserved. --}}
            </footer>
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        
        <script src="resources/js/app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- @include('sweetalert::alert') --}}
    </body>
    
    <script>
        @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        @endif
    </script> 
   
</html>