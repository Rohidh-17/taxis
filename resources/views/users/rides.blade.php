<html>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDzb6ZPaYmJ4cywYfvB3KOya3dD2xVHWfs&callback=initMap" async defer></script>

    <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
    
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
          
            // Location details
            // for (var i = 0; i < place.address_components.length; i++) {
            //     if(place.address_components[i].types[0] == 'postal_code'){
            //         document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            //     }
            //     if(place.address_components[i].types[0] == 'country'){
            //         document.getElementById('country').innerHTML = place.address_components[i].long_name;
            //     }
            // }
            // document.getElementById('location').innerHTML = place.formatted_address;
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lon').value = place.geometry.location.lng();
        });
        /////////////////To////////////////
        
        var input1 = document.getElementById('searchInput1');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input1);
    
        var autocomplete1 = new google.maps.places.Autocomplete(input1);
        autocomplete1.bindTo('bounds', map);
    
        var infowindow1 = new google.maps.InfoWindow();
        var marker1 = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
    
        autocomplete1.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place1 = autocomplete1.getPlace();
            if (!place1.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place1.geometry.viewport) {
                map.fitBounds(place1.geometry.viewport);
            } else {
                map.setCenter(place1.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place1.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker1.setPosition(place1.geometry.location);
            marker1.setVisible(true);
        
            var address1 = '';
            if (place1.address_components) {
                address1 = [
                  (place1.address_components[0] && place1.address_components[0].short_name || ''),
                  (place1.address_components[1] && place1.address_components[1].short_name || ''),
                  (place1.address_components[2] && place1.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place1.name + '</strong><br>' + address1);
            infowindow.open(map, marker1);
          
            // Location details
            // for (var i = 0; i < place1.address_components.length; i++) {
            //     if(place1.address_components[i].types[0] == 'postal_code'){
            //         document.getElementById('postal_code1').innerHTML = place1.address_components[i].long_name;
            //     }
            //     if(place1.address_components[i].types[0] == 'country'){
            //         document.getElementById('country1').innerHTML = place1.address_components[i].long_name;
            //     }
            // }
            // document.getElementById('location1').innerHTML = place1.formatted_address;
            document.getElementById('lat1').value = place1.geometry.location.lat();
            document.getElementById('lon1').value = place1.geometry.location.lng();
        });
    }
    </script>

@extends('layouts.shared')

@section('shared')
<div class="page-wrapper">
    <div class="page-content"> 
        @if(session()->has('rohidh'))
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
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
                        <li class="breadcrumb-item active" aria-current="page">Make Rides</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h4 class="mb-0 text-uppercase">Make Rides</h4>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.ridesStore') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Pick Up Location</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="searchInput" class="controls form-control" type="text" name="pickup" value="{{old('pickup')}}" placeholder="Enter a pick-up location">
                                    @error('pickup')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Latitude for Pickup</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="lat" name='lat' value="{{old('lat')}}" class="form-control" placeholder="Latitude for Pickup" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Longitude for Pickup </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="lon" name='lon' value="{{old('lon')}}" class="form-control" placeholder="Longitude for Pickup" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Destination Location</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="searchInput1" class="controls form-control" type="text" name="destination" value="{{old('destination')}}" placeholder="Enter a destination location">
                                    @error('destination')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div id="map"></div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Latitude for Destination</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="lat1" name='lat1' value="{{old('lat1')}}" class="form-control" placeholder="Latitude for Destination" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Longitude for Destination</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input id="lon1" name='lon1' value="{{old('lon1')}}" class="form-control" placeholder="Longitude for Destination" />
                                </div>
                            </div>

                                
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="date" class="form-control" id="date" name="date" value="{{old('date')}}" placeholder="Timings with AM and PM">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div> 

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Timings</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <input type="time" class="form-control" name="time" id="time" value="{{old('time')}}" placeholder="Timings with AM and PM">
                                @error('time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div> 

                            <button type="submit" class="btn btn-primary btn-sm">Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</html>

