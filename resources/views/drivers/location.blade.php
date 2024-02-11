
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDzb6ZPaYmJ4cywYfvB3KOya3dD2xVHWfs&libraries=places" ></script>

<button id="getLocationButton" onclick="getLocation()">Get My Current Location</button>
<div id="map" style="width: 1080px; height: 800px;"></div>

<script>
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
            var myCenter = new google.maps.LatLng(lat, lng);
            var mapCanvas = document.getElementById("map");
            var mapOptions = {
                center: myCenter,
                zoom: 20
            };
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter
            });
            marker.setMap(map);
            // Zoom to 9 when clicking on marker
            google.maps.event.addListener(marker, 'click', function () {
                map.setZoom(9);
                map.setCenter(marker.getPosition());
            });
        }
  </script>
  
