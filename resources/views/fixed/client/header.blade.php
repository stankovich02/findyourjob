<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">FindYourJob</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0 d-flex align-items-center">
            @foreach($data['nav'] as $nav)
                <a href="{{route($nav->route)}}" class="nav-item nav-link {{$data['active'] == $nav->route ? 'active' : ''}}">
                    {{$nav->name}}
                </a>
            @endforeach
            @if(session()->has("user"))
              <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    @if(session('accountType') === 'employee')
                        <img src="{{asset('assets/img/users/' . $data['user']->avatar)}}" alt="User Avatar" class="rounded-circle me-1" style="width: 30px; height: 30px;">
                        Welcome, {{$data['user']->first_name}}
                    @else
                        <img src="{{asset('assets/img/companies/' . $data['user']->logo)}}" alt="User Avatar" class="rounded-circle me-1" style="width: 30px; height: 30px;">
                        Welcome, {{$data['user']->name}}
                    @endif
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{route('account.index')}}" class="dropdown-item">Account</a>
                    <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                </div>
            </div>
            @else
            <a href="{{route("login")}}" class="nav-item nav-link ms-2">
                <i class="fa fa-user"></i>
                Login
            </a>
            @endif
        </div>

        <a href="{{route('jobs.create')}}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
