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
                        <li class="breadcrumb-item active" aria-current="page">Map Locations</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h6 class="mb-0 text-uppercase">Map Locations</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <style>
                            #map {
                            height: 400px;
                            width: 100%;
                            }
                        </style>

                        <div id="map"></div>
                        <script>
                            function initMap() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: 11.1271, lng: 78.6569},
                                zoom: 7 
                            });

                            
                            var locations = [
                                { name: 'Location A', lat: {{$ride->lat}}, lng: {{$ride->lon}} },
                                { name: 'Location B', lat: {{$ride->lat1}}, lng: {{$ride->lon1}} },
                            ];
1
                            locations.forEach(function(location) {
                                var marker = new google.maps.Marker({
                                position: { lat: location.lat, lng: location.lng },
                                map: map,
                                title: location.name
                                });

                                
                                var infowindow = new google.maps.InfoWindow({
                                content: '<b>' + location.name + '</b><br>Lat: ' + location.lat + '<br>Lng: ' + location.lng
                                });

                                marker.addListener('click', function() {
                                infowindow.open(map, marker);
                                });
                            });
                            }
                        </script>
                        <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzb6ZPaYmJ4cywYfvB3KOya3dD2xVHWfs&callback=initMap"
                            async
                            defer
                        ></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


