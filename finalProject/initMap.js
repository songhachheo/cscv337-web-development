function initMap() {
    var initPos = { lat: 32.2217, lng: -110.9264 };
    const map = new google.maps.Map(document.getElementById("map"), {
        center: initPos,
        zoom: 4,
    });

    var infowindow = new google.maps.InfoWindow({
        content: "Tucson, AZ",
    });

    var marker = new google.maps.Marker({
        position: initPos,
        map,
    });

    marker.addListener("click", function () {
        infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });
    });
};

function errorState(response) {
    var error = document.getElementById("errors");
    var message = (response.status + response.responseText);
    error.style.color = "red";
    error.innerHTML = message;
}

function getSearch() {
    var latitude = document.getElementById("latitude").value;
    var longitude = document.getElementById("longitude").value;
    var cache_id;
    var cache_type_id = document.getElementById("selCache").value;
    var difficulty_rating = document.getElementById("selDifficulty").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        switch (xhr.readyState) {
            case 0:
                console.log("Request is not initialized.");
                break;
            case 1:
                console.log("Server connection established.");
                break;
            case 2:
                console.log("Request received");
                break;
            case 3:
                console.log("Processing request");
                break;
            case 4:
                console.log("Request is finished and the response is ready!  This is where you want to process data.");
                break;
        };

        if (xhr.readyState == 4 && xhr.status == 200) {

            document.getElementById("btnSearch").disabled = false;
        };
        xhr.open("GET", "search.php?latitude=" + encodeURIComponent(latitude) + "&longitude=" + encodeURIComponent(longitude), true);
        xhr.send();
    };
};

function getCacheData() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        switch (xhr.readyState) {
            case 0:
                console.log("Request is not initialized.");
                break;
            case 1:
                console.log("Server connection established.");
                break;
            case 2:
                console.log("Request received");
                break;
            case 3:
                console.log("Processing request");
                break;
            case 4:
                console.log("Request is finished.");
                break;
        };

        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(xhr.responseText);
        } else if (xhr.readyState == 4 && xhr.status != 200) {
            console.log(xhr.status, xhr.responseText);
            errorState(xhr);
        }
    }
    xhr.open("GET", "search.php", true);
    xhr.send();

};

getCacheData();

window.initMap = initMap;