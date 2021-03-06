<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>Geo Cache</title>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="initMap.js"></script>
</head>

<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="container-fluid">
        <header>
            <h1>Geo Cache</h1>
        </header>
        <p>cache me outside</p>
        <div class="left-side">
            <form id="searchform" action="search.php" method="get">
                <fieldset class="h-100">
                    <div>
                        <label>Latitude: </label>
                    </div>
                    <input id="latitude" type="text" name="latitude" />
                    <div>
                        <label>Longitude: </label>
                    </div>
                    <input id="longitude" type="text" name="longitude" />
                    <div>
                        <input id="locate" class="btn fw-bold border-white bg-white" type="submit" value="LOCATE" />
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="right-side">
            <div id="map"></div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0gHEa6GDNoKxW_Da4L_FO8qSBHC1WOyU&callback=initMap" type="text/javascript" defer>
    </script>
</body>

</html>