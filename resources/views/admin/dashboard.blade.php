@extends('layouts.auth')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if(Auth::user()->role==1)
                <h2 class="text-align"> Welcome: {{Auth::user()->name}}</h2>
                @else
                <h2 class="text-align"> Welcome: {{Auth::user()->name}}</h2>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection