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
            <div class="breadcrumb-title pe-3">Driver</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="/index"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Location and Timings</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Edit Location and Timings</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">
    <form action="{{ route('drivers.handleEdit') }}" method="POST">
        @method('PUT')
        @csrf

        <input type="hidden" value="{{$ride->id}}" name="id"/>
        <div class="form-group">
            <label for="pickup" class="form-label">Pickup Location</label>
            <input type="text" class="form-control" readonly name="pickup" id="pickup" value="{{$ride->pickup}}">
            @error('pickup')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div><br />

        <div class="form-group">
            <label for="destination" class="form-label">Destination Location</label>
            <input type="text" class="form-control" readonly name="destination" readonly id="destination" value="{{$ride->destination}}">
            @error('destination')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div><br />

        <div class="form-group">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" name="time" id="time" value="{{$ride->time}}">
            @error('time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div><br />

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
