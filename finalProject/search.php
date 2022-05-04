<?php
$host = "localhost";
$port = "3306";
$user = "root";
$pass = "Be@rD0wN!";
$db = "test";
$pos = array();

try {
    $db = new PDO("mysql:host=$host:$port;dbname=$db", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$querytest = "SELECT `cache_id`, `latitude`, `longitude`, `cache_type_id`, `difficulty_rating` FROM `cache_data`";
$result =  $db->query($querytest);
if (!$result) {
    die("Query failed: " . $e->getMessage());
} else {
    while ($row = $result->fetchAll()) {
        $pos[] = array("cache_id:" => $row["cache_id"], "lat:" => $row["latitude"], "lng:" => $row["longitude:"], "cache_type_id:" => $row["cache_type_id"], "difficulty_rating" => $row["difficulty_rating"]);
        echo json_encode($pos);
    }
}
?>

<!--
<script type="text/javascript">
    var pos = <?php


                #echo json_encode($pos);


                ?>;
    
    
    $(document).ready(function() {
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            var mapOptions = {
                zoom: 15,
                center: new google.maps.LatLng(40.2118735, -8.4240415, 16),
                styles: [{
                    featureType: "administrative",
                    elementType: "all",
                    stylers: [{
                        visibility: "on"
                    }, {
                        saturation: -100
                    }, {
                        lightness: 20
                    }]
                }, {
                    featureType: "road",
                    elementType: "all",
                    stylers: [{
                        visibility: "on"
                    }, {
                        saturation: -100
                    }, {
                        lightness: 40
                    }]
                }, {
                    featureType: "water",
                    elementType: "all",
                    stylers: [{
                        visibility: "on"
                    }, {
                        saturation: -10
                    }, {
                        lightness: 30
                    }]
                }, {
                    featureType: "landscape.man_made",
                    elementType: "all",
                    stylers: [{
                        visibility: "simplified"
                    }, {
                        saturation: -60
                    }, {
                        lightness: 10
                    }]
                }, {
                    featureType: "landscape.natural",
                    elementType: "all",
                    stylers: [{
                        visibility: "simplified"
                    }, {
                        saturation: -60
                    }, {
                        lightness: 60
                    }]
                }, {
                    featureType: "poi",
                    elementType: "all",
                    stylers: [{
                        visibility: "off"
                    }, {
                        saturation: -100
                    }, {
                        lightness: 60
                    }]
                }, {
                    featureType: "transit",
                    elementType: "all",
                    stylers: [{
                        visibility: "off"
                    }, {
                        saturation: -100
                    }, {
                        lightness: 60
                    }]
                }]
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);

            for (var i = 0, l = points.length; i < l; i++) {
                var latLng = new google.maps.LatLng(points[i].lat, points[i].lng);
                var marker1 = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: points[i].name
                });
            }
        }
    });
</script>

-->