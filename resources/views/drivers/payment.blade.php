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
                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Payment</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">

                        <form action="{{route('drivers.handlePayment')}}" method="POST">
                            @csrf
                            <input type="hidden" name="ride_id" value="{{$ride->id}}">
                            <input type="hidden" name="driver_id" value="{{$ride->driver_id}}">
                            <input type="hidden" name="user_id" value="{{$ride->user_id}}">
                            <div class="form-group">
                                <label  class="form-label">Kilometer</label> <br />
                                <input type="number" step="0.1" class="form-control {{$errors->has('kilometer')? 'is-invalid':'' }}" id="km" name="kilometer"  value="{{old('kilometer')}}" placeholder="Enter the kilometer">
                                @if($errors->has('kilometer'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('kilometer')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <br/>
                            <div class="form-group">
                                <label  class="form-label">Price Per Kilometer</label><br />
                                <input type="number" step="0.1" class="form-control {{$errors->has('price_per_km')? 'is-invalid':'' }}" onchange="calc()" id="price" name="price_per_km"  value="{{old('price_per_km')}}" placeholder="Enter the price per km">

                                @if($errors->has('price_per_km'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('price_per_km')}}</strong>
                                    </span>
                                @endif
                            </div><br />
                            <div class="form-group">
                                <label class="form-label">Total Price</label><br />
                                <input type="number" readonly step="0.1" class="form-control {{$errors->has('total')? 'is-invalid':'' }}"  id="total" name="total"  value="{{old('total')}}" placeholder="Enter the price per km">

                                @if($errors->has('total'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('total')}}</strong>
                                    </span>
                                @endif
                            </div><br />
                            <button class="btn btn-primary btn-sm">Payment</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function calc()
    {
        var km = document.getElementById('km').value;
        var price = document.getElementById('price').value;
        document.getElementById('total').value = km*price;
    }
</script>