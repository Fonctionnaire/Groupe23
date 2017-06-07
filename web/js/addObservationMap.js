
    // INIT DE LA GOOGLE MAP
    var map;
    var currentUrl = document.location.href;

    function initMap() {

        var france = {lat: 46.460374, lng: 2.232049};

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: france
        });


        map.addListener('click', function (e) {

            placeMarkerAndPanTo(e.latLng, map);
        });

        // AFFICHE DU MARKER AU CLIC ET DE SA LOCALISATION LAT ET LNG

        var marker;

        function placeMarkerAndPanTo(latLng, map) {

            if (marker) {
                marker.setPosition(latLng);

            } else {
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });
                map.panTo(latLng);
            }
            $('.latitude').val(latLng.lat());
            $('.longitude').val(latLng.lng());

        }

        // GEOLOCALISATION

        //var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };


                $('.latitude').val(pos.lat);
                $('.longitude').val(pos.lng);

                map.setCenter(pos);
                map.setZoom(9);

                marker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: pos,
                    map: map

                });

            }, function () {
                handleLocationError(true, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Erreur: La géolocalisation n\'a pas fonctionné.' :
            'Erreur: Votre appareil ne supporte pas la géolocalisation.');

        // ========================================

    }
