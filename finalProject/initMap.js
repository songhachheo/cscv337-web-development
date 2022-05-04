function initMap() {
    const pos = { lat: 32.2217, lng: -110.9264 };
    const map = new google.maps.Map(document.getElementById("map"), {
        center: pos,
        zoom: 4,
    });

    const marker = new google.maps.Marker({
        position: { lat: 32.22155, lng: -110.96976 },
        map: map
    });

    const infowindow = new google.maps.InfoWindow({
        content: ""
    });

    marker.addListener('click', function () {
        infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });
    });
};
google.maps.event.addDomListener(window, "load", initMap);





