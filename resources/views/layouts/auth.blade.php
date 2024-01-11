<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User_Management system</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    @if(Auth::user())
                    @if(Auth::user()->role==1)
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('adminDashboard')) ? 'active' : '' }}" href="{{ route('adminDashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('userInformationByAdmin')) ? 'active' : '' }}" href="{{ route('userInformationByAdmin') }}">View Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('logout')) ? 'active' : '' }}" href="{{ route('logout') }}">Logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('userDashboard')) ? 'active' : '' }}" href="{{ route('userDashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('userViewInformation')) ? 'active' : '' }}" href="{{ route('userInformation',['email'=> Auth::user()->email]) }}">View Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('logout')) ? 'active' : '' }}" href="{{ route('logout') }}">Logout</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item-left">
                        <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>