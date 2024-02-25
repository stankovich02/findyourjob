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
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link active">
               {{-- <i class="fa fa-home"></i>--}}
                Home</a>
            <a href="/about" class="nav-item nav-link">
               {{-- <i class="fa fa-address-card"></i>--}}
                About</a>
            <a href="{{route('jobs.index')}}" class="nav-item nav-link">
                {{--  <i class="fa fa-address-card"></i>--}}
                Jobs</a>

            <a href="/contact" class="nav-item nav-link">
              {{--  <i class="fa fa-address-card"></i>--}}
                Contact</a>
            @if(session()->has("user"))
              <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    @if(session('accountType') === 'employee')
                        Welcome, {{session("user")->first_name}}
                    @else
                        Welcome, {{session("user")->name}}
                    @endif
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{route('account')}}" class="dropdown-item">Acoount</a>
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
