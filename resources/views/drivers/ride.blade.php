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
                        <li class="breadcrumb-item active" aria-current="page">Rides</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div id="map" style="width: 300px; height: 200px; float:right" class="m-3"></div>

        <form id="locationForm" action="{{ route('drivers.location') }}" method="post">
            @csrf
            <input id="address" hidden value="" name="address" class="controls" type="text" placeholder="Enter the location">
            <input id="lat" hidden value="" name="lat" class="form-control" />
            <input id="lon" hidden value="" name="lon" class="form-control" />
            <button id="updateLocationButton" style="float: right" class="btn btn-primary btn-sm">Update Live Location</button>
        </form>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                
                <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDzb6ZPaYmJ4cywYfvB3KOya3dD2xVHWfs&libraries=places" ></script>

                {{-- <button id="getLocationButton" onclick="getLocation()">Get My Current Location</button> --}}
                <script>
                    const updateInterval = 30000 *2;
                    function getLocation() {
                        
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition);
                        } else {
                            alert("Geolocation is not supported by this browser.");
                        }
                    }
                
                    function showPosition(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        document.getElementById("lat").value = lat;
                        document.getElementById("lon").value = lng;
                        var geocoder = new google.maps.Geocoder();
                        var myCenter = new google.maps.LatLng(lat, lng);
                        geocoder.geocode({ 'location': myCenter }, function (results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    var address = results[0].formatted_address;
                                    document.getElementById("address").value = address;
                                } else {
                                    alert("No address found for this location.");
                                }
                            } else {
                                alert("Geocoding failed due to: " + status);
                            }
                        });
                
                        var mapCanvas = document.getElementById("map");
                        var mapOptions = {
                            center: myCenter,
                            zoom: 20
                        };
                        var map = new google.maps.Map(mapCanvas, mapOptions);
                        var marker = new google.maps.Marker({
                            position: myCenter,
                            map: map
                        });
                        google.maps.event.addListener(marker, 'click', function () {
                            map.setZoom(9);
                            map.setCenter(marker.getPosition());
                        });
                        document.getElementById("updateLocationButton").addEventListener("click", function (event) {
                        event.preventDefault();
                        updateLocation();
                    });
                    }
                
                function updateLocation() {
                    $.ajax({
                        url: $("#locationForm").attr("action"),
                        type: 'POST',
                        data: $("#locationForm").serialize(),
                        success: function(response) {
                            alert("Location updated successfully");
                        },
                        error: function(error) {
                            alert("Error updating location");
                        }
                    });
                }
                getLocation();
                setInterval(getLocation, updateInterval);
                </script>

                <div id="message"></div>
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
                                    <th scope="col">Map Locations</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ride as $key => $i)
                                    <tr scope='row'>
                                        <td>{{$key+1}}</td>
                                        <td>{{$i->pickup}}</td>
                                        <td>{{$i->destination}}</td>
                                        <td>{{$i->date}}</td>
                                        <td>{{$i->time}}</td>
                                        <td>
                                            <a href="{{route('drivers.maplocations', $i->id)}}">Map</a>
                                        </td>
                                        <td>
                                            {{-- <a href='{{route('user.edit', $i->id)}}'
                                                class="btn btn-primary btn-sm py-0">Edit</a>
                                            <form action="{{route('user.delete', $i->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm py-0">Delete</button>
                                            </form> --}}
                                            @if($i->date < \Carbon\Carbon::today())
                                                -
                                            @else   
                                                <a href='{{route('drivers.accept', $i->id)}}' class="btn btn-danger btn-sm py-0">Accept Ride</a>

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection