@extends('layouts.loginregister')
@section('loginregister')
<div class="text-center mb-4">
    <h5 class="">Taxi App</h5>
    <p class="mb-0">Customer Login</p>
</div>
<div class="form-body">
    <form class="row g-3" action="{{route('users.handleLogin')}}" method="POST">
        @csrf
        <div class="col-12">
            <label for="txtUserName" class="form-label">Username</label>
            <input type="text" class="form-control" name="email" id="txtUserName" placeholder="Username">
        </div>
        <div class="col-12">
            <label for="txtPassword" class="form-label">Password</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control border-end-0" name="password" id="txtPassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
            </div>
        </div>


        <div class="col-12">
            <div class="d-grid">
                <button  class="btn btn-primary">Login</button>
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
        <span>New Customer ? <a href="{{route('users.register')}}">New Customer</a></span>
    </div>
</div>
@endsection