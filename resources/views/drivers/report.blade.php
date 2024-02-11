@extends('layouts.shared')
@section('shared')
<div class="page-wrapper">
    <div class="page-content">
        <?php
            $message = session()->get('rohidh');
            $mes = "";
            if($message=='Not allocated'){
                $mes='danger';
            }
            else {
                    $mes='success';
            }
        ?>
        @if(session()->has('rohidh'))
                <div class="alert alert-{{$mes}} border-0 {{ $mes === 'success' ? 'bg-success' : 'bg-danger' }} alert-dismissible fade show">
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
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Reports of the rides</h6>
                <hr/>
                
                    
<div class="tab-pane show active" role="tabpanel" id="tableDefaultDemo"
            aria-labelledby="tableDefaultDemoTab">
        <div class="p-3 p-sm-5">
            <h4 class="mb-0 text-uppercase">All Rides</h4><br/>
            <table class="table mb-0 table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pickup</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Date</th>
                    <th scope="col">Timings</th>
                    <th scope="col">Action</th>
                    <th scope="col">Map Locations</th>
                    <th scope="col">Payment Status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($ride as $key => $i)
                    <tr scope='row'>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $i->pickup }}</td>
                        <td>{{ $i->destination }}</td>
                        <td>{{ $i->date }}</td>
                        <td>{{ $i->time }}</td>
                        <td>
                            <a href="{{route('drivers.maplocations', $i->id)}}">Map</a>
                        </td>
                        <td>
                            @php
                                $allPaid = 1;
                            @endphp
                
                            @foreach ($payment as $p)
                                @if ($p->ride_id === $i->id)
                                    @if ($p->status == 'paid')
                                        
                                        @php
                                            $allPaid = 0;
                                            break; 
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            @if($allPaid == 0)
                                <button disabled class="btn btn-disabled btn-sm">Edit Ride</button>
                            @else
                                <a href='{{ route('drivers.edit', $i->id) }}' class="btn btn-primary btn-sm py-0">Edit Ride</a>

                            @endif
                         
                        <td>
                            @php
                                $allPaid = 1;
                            @endphp
                
                            @foreach ($payment as $p)
                                @if ($p->ride_id === $i->id)
                                    @if ($p->status == 'paid')
                                        
                                        @php
                                            $allPaid = 0;
                                            break; 
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            @if($allPaid == 0)
                            <span class="badge bg-gradient-quepal text-white shadow-sm w-100" style="height: 2rem; font-size:1.0rem;">Paid</span>
                                
                            @else
                                <span data-id="{{$i->id}}" class="edits btn btn-primary btn-sm py-0">Payment</span>
                                {{-- <a href='{{ route('drivers.payment', $i->id) }}' class="btn btn-primary btn-sm py-0">Payment</a> --}}
                            @endif
                
                            
                            {{-- <a href='{{ route('drivers.payment', $i->id) }}' class="btn btn-primary btn-sm py-0">Payment</a> --}}

                        </td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
            {{$ride->links()}}
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id='editshow'>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        @csrf
                        <input type="hidden" id="ride_id" name="ride_id">
                        <input type="hidden" id="driver_id" name="driver_id">
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="form-group">
                            <label class="form-label">Kilometer</label> <br />
                            <input type="number" step="0.1" class="form-control {{$errors->has('kilometer')? 'is-invalid':'' }}" id="kilometer" name="kilometer" value="{{old('kilometer')}}" placeholder="Enter the kilometer">
                            @if($errors->has('kilometer'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('kilometer')}}</strong>
                                </span>
                            @endif
                        </div>
                        <br />
                        <div class="form-group">
                            <label class="form-label">Price Per Kilometer</label><br />
                            <input type="number" step="0.1" class="form-control {{$errors->has('price_per_km')? 'is-invalid':'' }}" onchange="calc()"  id="price_per_km" name="price_per_km" value="{{old('price_per_km')}}" placeholder="Enter the price per km">

                            @if($errors->has('price_per_km'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('price_per_km')}}</strong>
                                </span>
                            @endif
                        </div><br />
                        <div class="form-group">
                            <label class="form-label">Total Price</label><br />
                            <input type="number"  step="0.1" class="form-control {{$errors->has('total')? 'is-invalid':'' }}" id="total" name="total" value="{{old('total')}}" placeholder="Total Price">

                            @if($errors->has('total'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('total')}}</strong>
                                </span>
                            @endif
                        </div><br />
                        <button onclick="updates();" class="btn btn-primary">Payment Allocate</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).on('click', '.edits', function (e) {
        e.preventDefault();
        var id = $(this).data("id");

        $("#editshow").modal('show');
        $.ajax({
            type: 'GET',
            url: '/payment/'+id,
            success: function (response) {
                console.log(response);
                $("#ride_id").val(response.records.id);
                $('#driver_id').val(response.records.driver_id);
                $('#user_id').val(response.records.user_id);
            }
        });
    });

    function updates() {
        var ride_id = $("#ride_id").val();
        var driver_id = $('#driver_id').val();
        var user_id = $('#user_id').val();
        var kilometer = $("#kilometer").val();
        var price_per_km = $("#price_per_km").val();
        var total = kilometer * price_per_km; 

        var formData = new FormData();
        formData.append('ride_id', ride_id);
        formData.append('driver_id', driver_id);
        formData.append('user_id', user_id);
        formData.append('kilometer', kilometer);
        formData.append('price_per_km', price_per_km);
        formData.append('total', total);

        $.ajax({
            type: 'POST',
            url: '/payment',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert('Payment Allocation successful');
            },
            error: function (xhr, status, error) {
                alert('Payment Update failed: ' + error);
            }
        });
    }

    function calc()
    {
        document.getElementById('total').value = document.getElementById('price_per_km').value * document.getElementById()
    }
</script>

            </div>
        </div>
    </div>
</div>

@endsection
