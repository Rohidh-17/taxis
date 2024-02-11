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
            <div class="breadcrumb-title pe-3">Customer</div>
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

        <div class="card">
            <div class="card-body">
                <h4>Reports</h4>
                <hr>
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Ride"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>
                  <div class="ms-auto"><a href="{{route('users.rides')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>New Ride</a></div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pickup</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Timings</th>
                                <th scope="col">Map Locations</th>
                                <th scope="col">Driver Name</th>
                                <th scope="col"></th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Ratings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $i)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">{{$key+1}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$i->pickup}}</td>
                                <td>{{$i->destination}}</td>
                                <td>
                                    
                                    @if($i->status == 'pending' && $i->date < \Carbon\Carbon::today())
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>Decline
                                        </div>
                                    @elseif($i->status == 'pending')
                                        <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>{{$i->status}}
                                        </div>
                                    @else
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>{{$i->status}}
                                        </div>
                                    @endif
                                    
                                    
                                </td>
                                
                                <td>{{$i->date}}</td>
                                <td>{{$i->time}}</td>
                                <td>
                                    <a href="{{route('users.maplocation', $i->id)}}">Map</a>
                                </td>
                                
                                @if ($i->driver_id != 0)
                                    @php
                                        $driver = \App\Models\Driver::findOrFail($i->driver_id);
                                    @endphp
                                    @if($driver)
                                        <td>{{ $driver->name }}</td>
                                    @else   
                                        <td>-</td>
                                    @endif
                                    <td><button class="btn btn-danger btn-sm" disabled>Cancel Ride</button></td>
                                    
                                @else   
                                <td><a href='{{route('users.delete', $i->id)}}' onclick='return deletes()' class="btn btn-danger btn-sm ">Cancel Ride</a>
                                </td>
                                @endif
                                @foreach($payment as $p)
                                    
                                    @if($p->ride_id === $i->id )
                                        @if($p->status == 'unpaid')
                                        {{-- <td><a href="{{route('users.handlePay', $i->id)}}" class="btn btn-warning btn-sm">Pay {{$p->total}}</a></td> --}}
                                        
                                        <td><a href="{{ route('users.handlePayment', ['id' => $i->id, 'pay' => $p->total]) }}" class="btn btn-warning btn-sm">Payment</a></td>

                                        @else
                                            <td>
                                                <span class="badge bg-gradient-quepal text-white shadow-sm w-100" style="height: 2rem; font-size:1.0rem;">Paid</span>
                                            </td>

                                                @php
                                                    $drivers = \App\Models\Rating::where('ride_id', $i->id)->first();
                                                @endphp
                                                    
                                                @if ($drivers!=null)
                                                   <td> <span class="badge bg-gradient-blooker text-white shadow-sm w-100" style="height: 2rem; font-size:0.9rem;">Rated with {{$drivers->rating}} stars
                                                    </span></td>
                                                @else
                                                   <td> <form action="{{ route('users.handleRating') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="ride_id" value="{{ $i->id  }}">

                                                    <select name="rating" id="rating">
                                                        <option value="1">1 - Poor</option>
                                                        <option value="2">2 - Fair</option>
                                                        <option value="3">3 - Good</option>
                                                        <option value="4">4 - Very Good</option>
                                                        <option value="5">5 - Excellent</option>
                                                    </select>
                                                
                                                    <button type="submit" class="btn btn-primary btn-sm">Submit Rating</button>
                                                </form>
                                                </td>
                                                    
                                                @endif
                                            </td>
                                        @endif
                                    @endif
                                @endforeach 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@verbatim
    <script>
        function deletes() {
            if (confirm("Are you sure want to Delete")) {
                alert('Deleted');
                return true;
            } else {
                return false;
            }
        }
    </script>
@endverbatim

@endsection



                        
{{-- @if ($i->driver_id != 0)
    <td>{{$driver->name}}</td>
    <td><button disabled>Cancel Ride</button></td>
@else
    <td>-</td>
    <td>
        {{-- <a href='{{route('user.edit', $i->id)}}'
            class="btn btn-primary btn-sm py-0">Edit</a>
        <form action="{{route('user.delete', $i->id)}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-warning btn-sm py-0">Delete</button>
        </form> 
        <a href='{{route('users.delete', $i->id)}}' onclick='return deletes()' class="btn btn-danger btn-sm ">Cancel Ride</a>

    </td>
    {{-- <td>
        @if($i->created_at < now())
            no ride
        @else

            having
        @endif
    </td> 
    @endif --}}
                                    
