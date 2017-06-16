var map3;
var allMarkers = [];
var markers;

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
        var viewObsId = row.find(".obsId p");
        var dateObs = row.find('.obsDate p');
        var i;
        var urlViewObs = 'http://localhost/Groupe23/web/app_dev.php/viewObservation/';

        // INFOWINDOWS SUR LES MARKERS
        function addInfo(){

            var contentString =
                '<h4 class="titre-infowindow"> Observation</h4>' +
                    '<p class="text-infowindow">Date de l\'observation : '+ dateObs[i].textContent +' </p>' +
                    '<p class="lat-lng">Latitude: '+ latitudes[i].textContent +' </p>' +
                    '<p class="lat-lng">Longitude: '+ longitudes[i].textContent +' </p>' +
                '<p><a class="pathObs" href="'+ urlViewObs + viewObsId[i].textContent +'"> Voir cette observation</a></p>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 350
            });

            google.maps.event.addListener(markers,'click', (function(markers,content,infowindow){

                return function() {
                    infowindow.close();
                    infowindow.open(map3, markers);

                };
            })(markers,contentString,infowindow));
        }


        // =================================

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
                addInfo();
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

                addInfo();
            }
        }

    });

