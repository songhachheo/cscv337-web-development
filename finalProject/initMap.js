function initMap() {
    const tucson = { lat: 32.2217, lng: -110.9264 };
    const map = new google.maps.Map(document.getElementById("map"), {
        center: tucson,
        zoom: 4,
    });

    const marker = new google.maps.Marker({
        position: { lat: 32.22155, lng: -110.96976 },
        map: map
    });

    const infowindow = new google.maps.InfoWindow({
        content: "Cache me outside.",
    });

    marker.addListener('click', function () {
        console.log("Marker clicked", marker);
        infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });
    });
};
window.initMap = initMap;


