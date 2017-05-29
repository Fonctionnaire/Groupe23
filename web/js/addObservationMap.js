
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

        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('<h4 id="titre-infowindow">Vous êtes ici</h4>' + '<br>' + '<p>Latitude : ' + position.coords.latitude + '</p>' + '<p>Longitude : ' + position.coords.longitude + '</p>');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Erreur: La géolocalisation n\'a pas fonctionné.' :
            'Erreur: Votre appareil ne supporte pas la géolocalisation.');

        // ========================================

    }
