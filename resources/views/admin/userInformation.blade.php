<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 10 Custom User Registration & Login </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('AuthDashboard')) ? 'active' : '' }}" href="{{ route('AuthDashboard') }}">dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="justify-content-center mt-5">
        @if ($message = Session::get('success'))
        <div class="justify-content-center mt-5 alert alert-success">
            {{ $message }}
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roll</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1;$i<count($users);$i++) <tr>
                    <td>{{$users[$i]->id}}</td>
                    <td>{{$users[$i]->name}}</td>
                    <td>{{$users[$i]->email}}</td>
                    <td>{{$users[$i]->Roll_id}}</td>
                    <td>
                        <a class="" href="{{ route('deleteUserByAdmin',[$users[$i]->id])}}">Delete</a>
                    </td>
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>
</body>

</html>