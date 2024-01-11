@extends('layouts.auth')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Enable/Desable User here</div>
            <div class="card-body">
                <form action="{{ route('saveUserEnableStatus',[$users->id]) }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{($users->name) }}">
                            @if ($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{($users->email) }}">
                            @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="role" class="col-md-4 col-form-label text-md-end text-start">Enable/Desable User</label>
                        <div class="col-md-6">
                            <select class="form-control @error('is_email_verified') is-invalid @enderror" id=" is_email_verified" name="is_email_verified">
                                <option>Select</option>
                                <option value="1">Enable</option>
                                <option value="0">Desable</option>
                            </select>
                            @if ($message = Session::get('error'))
                            <small class=" text-danger">{{ $message }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection