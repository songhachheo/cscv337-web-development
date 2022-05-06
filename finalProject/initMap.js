var pos_1 = { lat: 32.2217, lng: -110.9264 };
var marker_1;
var infowindow;

function initMap(pos_1, marker_1, infowindow) {
    var map = new google.maps.Map(document.getElementById("map"), {
        center: pos_1,
        zoom: 4,
    });

    marker_1 = new google.maps.Marker({
        position: pos_1,
        map: map
    });

    infowindow = new google.maps.InfoWindow({
        content: "Tucson, AZ"
    });

    marker_1.addListener('click', function () {
        infowindow.open({
            anchor: marker_1,
            map,
            shouldFocus: true,
            zoom: 8
        });
    });
};

window.initMap = initMap();

// USE THIS FUNCTION FOR THE LIST OF MARKERS AND POINTS
//var mapElement = document.getElementById('map');
//var map = new google.maps.Map(mapElement, mapOptions);
//for (var i = 0, l = points.length; i < l; i++) {
//    var latLng = new google.maps.LatLng(pos[i].lat, pos[i].lng);
//    var marker1 = new google.maps.Marker({
//        pos: latLng,
//        map: map,
//        title: pos[i].name
//    });
//}

/*
var geocoder;
var map;

function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(48.291876, 16.339551);
    var mapOptions = {
        zoom: 16,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    codeAddress()
}

function getAddr() {
    // var image = 'http://ratemycondo.ca/wp-content/uploads/icons/map-icon-orange-bldg.png';
    // var address = '<?php echo $property_address; ?>, <?php echo $property_zip; ?>';
    geocoder.geocode({
        //'address': address
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                icon: image,
                position: results[0].geometry.location
            });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

initialize();
*/




