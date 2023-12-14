<?php

session_start();
session_regenerate_id(true);

if(!isset($_SESSION['user_role']) && $_SESSION['user_role']!='client'){
    header('location:userLogin.php');
    die();
}
// Create a new connection to the database
require('config.php');
// Fetch the arena data from the database
$sql = "SELECT * FROM arena";
$result = $con->query($sql);

// Create an array to store the arena data
$arenas = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $arenas[] = $row;
  }
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Arena Details</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>
<body>
  <h1>Arena Details</h1>

  <?php foreach ($arenas as $arena) { ?>
    <h2><?php echo $arena['name']; ?></h2>
    <p><?php echo $arena['description']; ?></p>
    <div id="map-<?php echo $arena['a_id']; ?>"></div>

    <script>
      var map<?php echo $arena['a_id']; ?> = L.map('map-<?php echo $arena['a_id']; ?>').setView([<?php echo $arena['latitude']; ?>, <?php echo $arena['longitude']; ?>], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(map<?php echo $arena['a_id']; ?>);
      L.marker([<?php echo $arena['latitude']; ?>, <?php echo $arena['longitude']; ?>]).addTo(map<?php echo $arena['a_id']; ?>);
    </script>
  <?php } ?>

  <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
</body>
</html>
