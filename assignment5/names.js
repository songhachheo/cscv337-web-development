function runOnLoad() {
    getNames();
    document.getElementById("babyselect").onchange = selectionMade;
};

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
        };
        document.getElementById("babyselect").disabled = false;
    };
    httpRequest.open("GET", "http://u.arizona.edu/~milazzom/cscv337/sp19/hw5/babynames.php?type=list", true);
    httpRequest.send();
};

function selectionMade() {
    var selectedName = document.getElementById("babyselect").value;
    console.log("The selected name is: ", selectedName);
    getNameMeaning(selectedName);
    getNameRankData(selectedName);
};
/*
function getNameRankData(selectedName) {
    console.log("Getting name rank data!");
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log("This request succeeded!", httpRequest.responseText);
            var rank = httpRequest.responseXML.getElementsByTagName("rank");
            console.log("There are " + rank.length + " rank elements returned!");
            var ranks = "";
            for (var i = 0; i < rank.length; i++) {
                var currentRank = rank[i];
                if (ranks == "") {
                    ranks += currentRank.textContent;
                } else {
                    ranks += ", " + currentRank.textContent;
                };
            };
            document.getElementById("graph").innerText = ranks;
        };
    };
    httpRequest.open("GET", "http://u.arizona.edu/~milazzom/cscv337/sp19/hw5/babynames.php?type=rank&name=" + encodeURIComponent(selectedName), true);
    httpRequest.send();
};
*/
function getNameRankData(selectedName) {
    console.log("Getting name rank data!");
    var httpRequest = new XMLHttpRequest();
    var ranks = document.getElementById("graph");
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            console.log("This request succeeded!", httpRequest.responseText);
            var rank = httpRequest.responseXML.getElementsByTagName("rank");
            console.log("There are " + rank.length + " rank elements returned!");
            var years = document.createElement("tr");
            var rankNumbers = document.createElement("tr");
            for (var i = 0; i < rank.length; i++) {
                var header = document.createElement("th");
                header.innerText = rank[i].getAttribute("year");
                years.appendChild(header);
                var tempDiv = document.createElement("div");
                //tempDiv.style.backgroundColor = "#FBB";
                //tempDiv.style.width = "50px";
                //tempDiv.style.textAlign = "center";
                var rankNumber = parseInt(rank[i].textContent);
                // Only set the height above zero if the rankNumber is above 0
                if (rankNumber > 0) {
                    // If rank is between 1 and 10 make the text red
                    if (rankNumber <= 10) {
                        tempDiv.style.color = "red";
                    }
                    tempDiv.style.height = Math.floor((1000 - rankNumber) / 4) + "px";
                } else {
                    tempDiv.style.height = "0px";
                }
                tempDiv.innerText = rankNumber;
                var td = document.createElement("td");
                //td.style.height = "250px";
                //td.style.verticalAlign = "bottom";
                td.appendChild(tempDiv);
                rankNumbers.appendChild(td);
            }
            ranks.appendChild(years);
            ranks.appendChild(rankNumbers);
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
    }
    httpRequest.open("GET", `http://u.arizona.edu/~milazzom/cscv337/sp19/hw5/babynames.php?type=meaning&name=${selectedName}`, true);
    httpRequest.send();
}

function reset() {
    document.getElementById("babyselect").value = "Select a name...";
    document.getElementById("meaning").innerHTML = "";
    document.getElementById("graph").innerText = "";
};

document.addEventListener('DOMContentLoaded', function () {
    runOnLoad();
}, false);
