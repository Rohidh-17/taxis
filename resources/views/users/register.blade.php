@extends('layouts.loginregister')
@section('loginregister')
<div class="text-center mb-4">
    <h5 class="">Taxi App</h5>
    <p class="mb-0">Customer Register</p>
</div>
<div class="form-body">
    <form class="row g-3" action="{{ route('users.handleRegister') }}" method="POST">
        @csrf
        <div class="col-12">
            <label for="txtUserName" class="form-label">Username</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="txtUserName" placeholder="Enter Username">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-12">
            <label for="txtPassword" class="form-label">Password</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control" name="password" id="txtPassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="confirm_password" class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control border-end-0" id="confirm_password" placeholder="Enter Repeat Password">
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control border-end-0" value="{{ old('phone') }}" placeholder="Enter Phone Number">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-12">
            <div class="d-grid">
                <button  class="btn btn-primary">Register</button>
            </div>
        </div>

        {{-- <div ng-show="LoginLoader">
            <center>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </center>
        </div> --}}

    </form>
    <div  class="mt-3">
        <span>Existing Customer ? <a href="{{route('users.login')}}">Login</a></span>
    </div>
</div>
@endsection
