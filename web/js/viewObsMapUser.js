var map6;
var markers;
var viewLat = $('#view-obs-latitude').html();
var viewLng = $('#view-obs-longitude').html();



function initMap() {

    var obsMarker = {lat: parseFloat(viewLat), lng: parseFloat(viewLng)};

    map6 = new google.maps.Map(document.getElementById('view-obs-map'), {
        zoom: 7,
        maxZoom: 11,
        center: obsMarker
    });

    markers = new google.maps.Marker({
        animation: google.maps.Animation.DROP,
        position: {lat: parseFloat(viewLat),
            lng: parseFloat(viewLng)
        },
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 30,
            fillColor: 'red',
            fillOpacity: 0.5,
            strokeWeight: 1,
            strokeColor: 'red'
        },
        map: map6
    });
}
