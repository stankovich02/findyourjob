<!DOCTYPE html>
<html lang="en">
<head>
    @include('fixed.admin.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('assets/img/logo.png')}}" alt="FindYourJob Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/img/users/'. session()->get('user')->avatar)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <p class="text-white">{{session()->get('user')->first_name}}</p>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link @if($active == 'admin.index') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item @if($active == 'admin.jobs.index' || $active == 'admin.jobs.pending' || $active == 'admin.jobs.boosted') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Jobs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.jobs.index')}}" class="nav-link @if($active == 'admin.jobs.index') active @endif">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Active Jobs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.jobs.pending')}}" class="nav-link @if($active == 'admin.jobs.pending') active @endif">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Pending Jobs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.jobs.boosted')}}" class="nav-link @if($active == 'admin.jobs.boosted') active @endif">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Boosted Jobs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($active == 'admin.companies.index' || $active == 'admin.companies.pending') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Companies
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.companies.index')}}" class="nav-link @if($active == 'admin.companies.index') active @endif">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Active Companies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.companies.pending')}}" class="nav-link @if($active == 'admin.companies.pending') active @endif">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Pending Companies</p>
                            </a>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}" class="nav-link @if($active == 'admin.users.index') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.categories.index')}}" class="nav-link @if($active == 'admin.categories.index') active @endif">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.cities.index')}}" class="nav-link @if($active == 'admin.cities.index') active @endif">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            Cities
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.roles.index')}}" class="nav-link @if($active == 'admin.roles.index') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.navs.index')}}" class="nav-link @if($active == 'admin.navs.index') active @endif">
                        <i class="nav-icon fas fa-link"></i>
                        <p>
                            Navigations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.seniorities.index')}}" class="nav-link @if($active == 'admin.seniorities.index') active @endif">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Seniorities
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.technologies.index')}}" class="nav-link @if($active == 'admin.technologies.index') active @endif">
                        <i class="nav-icon fas fa-code"></i>
                        <p>
                            Technologies
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.workplaces.index')}}" class="nav-link @if($active == 'admin.workplaces.index') active @endif">
                        <i class="nav-icon fas fa-laptop-house"></i>
                        <p>
                            Workplaces
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.newsletters.index')}}" class="nav-link @if($active == 'admin.newsletters.index') active @endif">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Newsletters
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
    @yield('content')
</div>
    @include('fixed.admin.scripts')
</body>
</html>
