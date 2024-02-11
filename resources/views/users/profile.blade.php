@extends('layouts.shared')

@section('shared')

<div class="page-wrapper">
    <div class="page-content">
        @if(session()->has('rohidh'))
                <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
                    <div class="text-white">{{ session()->get("rohidh") }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if (Auth::user()->image == null)
                                        <img src="/assets/images/avatars/avatar-2.png" alt="Customer" class="rounded-circle p-1 bg-primary" width="110">
                                    @else
                                        <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}" class="rounded-circle p-1 bg-primary" width="110" alt="no image"></td>
                                    @endif
                                    <div class="mt-3">
                                        <h4>{{auth()->user()->name}}</h4>
                                        <p class="text-secondary mb-1">Customer</p>
                                        
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="lni lni-user"></i>&nbsp;Username</h6>
                                        <span class="text-secondary">{{$user->name}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="lni lni-link"></i>&nbsp;Email</h6>
                                        <span class="text-secondary">{{$user->email}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="lni lni-phone"></i>&nbsp;Phone Number</h6>
                                        <span class="text-secondary">{{$user->phone}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3>Profile Update</h3><br>
                                <form action="{{ route('users.handleUpdate') }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" value="{{$user->id}}" name="id"/>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="email" class="form-control" readonly id="email" value="{{$user->email}}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{$user->phone}}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Profile Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input class="form-control {{$errors->has('image')? 'is-invalid':'' }}" 
                                            type="file" name="image" id="image">
                                        @if($errors->has('image'))
                                            <span class="invalid-feedback">
                                                <strong>{{$errors->first('image')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" class="btn btn-primary bt-sm">Update</button> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
