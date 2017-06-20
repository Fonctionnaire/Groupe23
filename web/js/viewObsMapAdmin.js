
    var map5;
    var markers;
    var viewLat = $('#view-obs-latitude').html();
    var viewLng = $('#view-obs-longitude').html();

    function initMap() {

        var obsMarker = {lat: parseFloat(viewLat), lng: parseFloat(viewLng)};

        map5 = new google.maps.Map(document.getElementById('view-obs-map'), {
            zoom: 7,
            center: obsMarker
        });

        markers = new google.maps.Marker({
            animation: google.maps.Animation.DROP,
            position: {lat: parseFloat(viewLat),
                lng: parseFloat(viewLng)
            },
            map: map5
        });
    }


