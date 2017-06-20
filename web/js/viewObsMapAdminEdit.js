var map7;
var markers;
var editViewLat = $('.view-edit-obs-latitude').val();
var editViewLng = $('.view-edit-obs-longitude').val();

function initMap() {

    var obsMarker = {lat: parseFloat(editViewLat), lng: parseFloat(editViewLng)};

    map7 = new google.maps.Map(document.getElementById('admin-map-edit-obs'), {
        zoom: 7,
        center: obsMarker
    });

    markers = new google.maps.Marker({
        animation: google.maps.Animation.DROP,
        position: {lat: parseFloat(editViewLat),
            lng: parseFloat(editViewLng)
        },
        map: map7
    });
}