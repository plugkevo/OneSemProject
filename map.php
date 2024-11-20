<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'african_shipping_short';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);

$coordinates = array();
$latitudes = array();
$longitudes = array();

$result = null;

$search_imo_no = ""; // Initialize the search input variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_imo_no = $_POST["imo_no"]; // Get the entered imo_no from the form
}

// Step 4: Fetch data from the selected table
$sql = "SELECT locationLatitude, locationLongitude FROM Location_tab WHERE ship_imo = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $search_imo_no); // Assuming imo_no is a string
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $latitudes[] = $row['locationLatitude'];
    $longitudes[] = $row['locationLongitude'];
    $coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] . ',' . $row['locationLongitude'] . '),';
}

// Remove the comma ',' from last coordinate
if (count($coordinates) > 0) {
    $lastcount = count($coordinates) - 1;
    $coordinates[$lastcount] = trim($coordinates[$lastcount], ",");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style12.css">
    <title>Map | View</title>
</head>
<style>
    body{
		font-family: Arial;
	    margin: 5px 100px 0px 100px;
	    padding: 0;
	    color: white;
	    text-align: center;
	    
	}
    .outer-scontainer{
        margin-top: 80px;
    }
    .search{
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<body>
    <?php require_once('navbar.html'); ?>

    <div class="outer-scontainer">
        <form class="form-horizontal" action="map.php" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
            <div class="search">
                <div class="form-group">
                    <label for="search_item_no">Search by IMO Number:</label>
                    <input type="text" class="form-control" id="search_imo_no" name="imo_no" value="<?php echo htmlspecialchars($search_imo_no); ?>" placeholder="Enter IMO Number">
                </div>
                <div class="form-group">
                    <button type="submit" style="margin-top: 10px;" class="btn btn-primary">Search</button>
                </div>
            </div>
            
        </form>
        <div id="map" style="width: 100%; height: 80vh;"></div>

        <script>
            function initMap() {
                var mapOptions = {
                    zoom: 18,
                    center: {lat: <?php echo count($latitudes) > 0 ? $latitudes[0] : 0; ?>, lng: <?php echo count($longitudes) > 0 ? $longitudes[0] : 0; ?>},
                    mapTypeId: google.maps.MapTypeId.SATELITE
                };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                var RouteCoordinates = [
                    <?php
                    $i = 0;
                    while ($i < count($coordinates)) {
                        echo $coordinates[$i];
                        $i++;
                    }
                    ?>
                ];

                var RoutePath = new google.maps.Polyline({
                    path: RouteCoordinates,
                    geodesic: true,
                    strokeColor: '#1100FF',
                    strokeOpacity: 1.0,
                    strokeWeight: 10
                });

                var mark = 'images/mark.png';
                var flag = 'images/flag.png';

                var startPoint = {lat: <?php echo count($latitudes) > 0 ? $latitudes[0] : 0; ?>, lng: <?php echo count($longitudes) > 0 ? $longitudes[0] : 0; ?>};
                var endPoint = {lat: <?php echo count($latitudes) > 0 ? $latitudes[$lastcount] : 0; ?>, lng: <?php echo count($longitudes) > 0 ? $longitudes[$lastcount] : 0; ?>};

                var marker = new google.maps.Marker({
                    position: startPoint,
                    map: map,
                    icon: mark,
                    title: "Start point!",
                    animation: google.maps.Animation.BOUNCE
                });

                var marker = new google.maps.Marker({
                    position: endPoint,
                    map: map,
                    icon: flag,
                    title: "End point!",
                    animation: google.maps.Animation.DROP
                });

                RoutePath.setMap(map);
            }

            google.maps.event.addDomListener(window, 'load', initMap);
        </script>

        <!-- Remember to put your Google Maps API key -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script>
    </body>
</html>