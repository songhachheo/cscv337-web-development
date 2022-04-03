function runOnLoad() {
    getNames();
    document.getElementById("babyselect").onchange = selectionMade;
    reset()
};

function errorState(response) {
    var error = document.getElementById("errors");
    var message = (response.status + response.responseText);
    error.style.color = "red";
    error.innerHTML = message;
}

function getNames() {
    var select = document.getElementById("babyselect");
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        switch (httpRequest.readyState) {
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

        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log("This request succeeded!", httpRequest.responseText);
            var names = httpRequest.responseText.split("\n");
            console.log("There are " + names.length + " names returned!");

            for (var i = 0; i < names.length; i++) {
                var currentName = names[i];
                var option = new Option(currentName, currentName);
                select.add(option, true);
            };
        }
        document.getElementById("babyselect").disabled = false;
    };
    httpRequest.open("GET", "http://u.arizona.edu/~milazzom/cscv337/sp19/hw5/babynames.php?type=list", true);
    httpRequest.send();
};

function selectionMade() {
    reset();
    var selectedName = document.getElementById("babyselect").value;
    console.log("The selected name is: ", selectedName);
    getNameMeaning(selectedName);
    getNameRankData(selectedName);
};

function getNameRankData(selectedName) {
    console.log("Getting name rank data!");
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log("This request succeeded!", httpRequest.responseText);
            var ranks = httpRequest.responseXML.getElementsByTagName("rank");
            var graph = document.getElementById("graph");
            console.log("There are " + ranks.length + " rank elements returned!");
            var startDiv = 10;
            for (var i = 0; i < ranks.length; i++) {
                var rank = ranks[i].textContent;
                var barHeight = parseInt((1000 - rank) / 4);
                var years = document.createElement("p");
                years.style.left = startDiv + "px";
                graph.appendChild(years);
                var rankingDiv = document.createElement("div");
                rankingDiv.style.left = startDiv + "px";
                startDiv += 60;
                graph.appendChild(rankingDiv);
                years.innerHTML = ranks[i].getAttribute("year");
                rankingDiv.innerHTML = rank;
                years.classList.add("year");
                rankingDiv.classList.add("ranking");
                if (rank == 0) {
                    rankingDiv.style.height = 0;
                } else {
                    rankingDiv.style.height = barHeight + "px";
                }
            }
        } else if (httpRequest.readyState == 4 && httpRequest.status != 200) {
            errorState(httpRequest);
        }
    }
    httpRequest.open("GET", "http://u.arizona.edu/~milazzom/cscv337/sp19/hw5/babynames.php?type=rank&name=" + encodeURIComponent(selectedName), true);
    httpRequest.send();
};

function getNameMeaning(selectedName) {
    console.log("Getting name meaning data!");
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log("This request succeeded!", httpRequest.responseText);
            document.getElementById("meaning").innerHTML = httpRequest.responseText;
        }
        else if (httpRequest.readyState == 4 && httpRequest.status != 200) {
            document.getElementById("meaning").innerHTML = "Baby Name " + selectedName + " does not have any associated meaning.";
        }
    }
    httpRequest.open("GET", `http://u.arizona.edu/~milazzom/cscv337/sp19/hw5/babynames.php?type=meaning&name=${selectedName}`, true);
    httpRequest.send();
}

function reset() {
    document.getElementById("meaning").innerHTML = "";
    document.getElementById("graph").innerHTML = "";
    document.getElementById("errors").innerHTML = "";
};

document.addEventListener('DOMContentLoaded', function () {
    runOnLoad();
}, false);
