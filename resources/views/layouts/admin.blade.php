<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed " style="height: auto;">
    <div class="wrapper" id="app">

        <!-- navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- left navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/home" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('user.profile') }}" class="nav-link">Profile</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('logout') }}" class="nav-link"                             
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off" style="color: #F13E18;"></i>
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/home" class="brand-link">
                <!-- <img src="" alt="Logo" class="brand-image img-circle elevation-10" style="opacity: 2"> -->
                <span class="brand-text font-weight-light"> SSTS</span>
            </a>
        
            <!-- sidebar -->
            <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block text-center">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                    <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- dashboard -->
                        <li class="nav-item">
                            <a href="/home" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @can('Create User')
                        <!-- //Management -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            
    
                            <ul class="nav nav-treeview">
                                @can('Create Role')
                                <li class="nav-item">
                                    <a href="{{ route('role.index')}}" class="nav-link">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                            <p>Roles</p>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{ route('permission.index')}}" class="nav-link">
                                        <i class="fas fa-user-lock nav-icon"></i>
                                            <p>Permissions</p>
                                    </a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Users</p>
                                </a>
                                </li> 
                            </ul>
                        </li>
                        @endcan

                        @can('Create Report')
                        <!-- proj -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                                <p>Project List</p>
                            </a>
                        </li>

                        <!-- Lect -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                                <p>Lecturers</p>
                            </a>
                        </li>

                        <!-- stud -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Students</p>
                            </a>
                        </li>

                        <!-- rep -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Analytics</p>
                            </a>
                        </li>
                        @endcan

                        @can('Create Meeting')
                        <!-- meet -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Meeting</p>
                            </a>
                        </li>

                        <!-- subs -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Submission</p>
                            </a>
                        </li>
                        @endcan

                        @can('Create Progress')
                        <!-- prog -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Progress</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->

            </div> 

        </aside>
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 230px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Student Supervision Tracking System</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title') </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                @include('partials.alert')
                @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>        
    
    </div>
    <!-- content wrapper -->




</body>

  <footer class="main-footer">
    <strong>Copyright © 2022</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

</html>
