@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @elseif ($message = Session::get('error'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @elseif ($message = Session::get('message'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
            @endif
            <div class="card">
                <div class="card-body ">
                    welcome our Page
                </div>
            </div>
        </div>
    </div>
</div>
@endsection