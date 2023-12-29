@extends('layouts.auth')

@section('content')
<div class="justify-content-center mt-5">
    @if ($message = Session::get('success'))
    <div class="justify-content-center mt-5 alert alert-success">
        {{ $message }}
    </div>
    @endif
    <table class="table table-bordered ">
        @if(Auth::user()->role==1)
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created Time</th>
                <th>Updated Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            @if($user->role==0)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><a href="{{ route('updateUserRoleIndex',[$user->id])}}" title="Click to change role">
                        <button class="btn">@if($user->role==0) User @endif</button></a>
                </td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>
                    <a class=" btn btn-danger " href=" {{ route('deleteUserByAdmin',[$user->id])}}">Delete</a>
                    <a class="btn btn-dark" href="{{ route('updateUserIndex',[$user->id])}}">Edit</a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
        @else
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a class="btn btn-danger " href="{{ route('deleteUserByUser',[$user->id])}}">Delete</a>
                    <a class="btn btn-dark" href="{{ route('update',[$user->id,'email'=>$user->email])}}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
</div>
@endsection