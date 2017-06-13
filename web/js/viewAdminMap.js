var map3;
var allMarkers = [];
var markers;
var currentUrl = document.location.href;
var domain = 'nao.groupe23.ovh';

var localDevUrl = 'http://localhost/Groupe23/web/app_dev.php/admin/listTaxrefs';
var localProdUrl = 'http://localhost/Groupe23/web/admin/listTaxrefs';
var srvDevUrl = domain + '/app_dev.php/admin/listTaxrefs';
var srvProdUrl = domain + '/admin/listTaxrefs';


if (currentUrl === localDevUrl ||
    currentUrl === localProdUrl ||
    currentUrl === srvDevUrl ||
    currentUrl === srvProdUrl )

{
    function initMap() {

        var france = {lat: 46.460374, lng: 2.232049};

        map3 = new google.maps.Map(document.getElementById('map-view'), {
            zoom: 5,
            center: france
        });
    }

    function toggleMarkers() {
        for (i = 0; i < allMarkers.length; i++) {
            allMarkers[i].setMap(null);

        }
        allMarkers = [];
    }

    // AFFICHAGE DES MARKER D'OBS SUR LA MAP

    // supprime les markercluster si il y en a
    var markerCluster;
    $('.filtre-td').click(function(){
        if(!markerCluster){


            markerCluster = new MarkerClusterer(map3, allMarkers,
                {
                    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }else{
            markerCluster.clearMarkers();
            markerCluster = new MarkerClusterer(map3, allMarkers,
                {
                    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }

    });

    // affiche les marqueur de l'espèce choisie sur la map
    $('.filtrer').click(function(){

        var row = $(this).closest("tr");
        var longitudes = row.find(".longitude p");
        var latitudes = row.find(".latitude p");
        var i;

        toggleMarkers();

        if (markers){

            for (i = 0; i < latitudes.length && i < longitudes.length; i++)
            {

                markers = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: {lat: parseFloat(latitudes[i].textContent),
                        lng: parseFloat(longitudes[i].textContent)
                    },
                    map: map3
                });

                map3.setZoom(5);
                allMarkers.push(markers);
            }

        }else{
            for (i = 0; i < latitudes.length && i < longitudes.length; i++)
            {
                console.log(latitudes[i].textContent);
                markers = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: {lat: parseFloat(latitudes[i].textContent),
                        lng: parseFloat(longitudes[i].textContent)
                    },
                    map: map3
                });
                allMarkers.push(markers);
            }
        }
    });
}
