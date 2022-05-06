function initMap() {
    var initPos = { lat: 32.2217, lng: -110.9264 };
    const map = new google.maps.Map(document.getElementById("map"), {
        center: initPos,
        zoom: 4
    });

    var marker = new google.maps.Marker({
        position: initPos,
        map: map
    });

    var infowindow = new google.maps.InfoWindow({
        content: "Tucson, AZ",
        map: map
    });

    marker.addListener("click", function () {
        infowindow.open({
            anchor: marker,
            map: map,
        });
    });
};

window.initMap = initMap;