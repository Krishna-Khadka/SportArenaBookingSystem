<?php
// Establish a database connection (update with your credentials)
// $host = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'saloon_db';

// $conn = mysqli_connect($host, $username, $password, $database);
// if (!$conn) {
//   die('Database connection error: ' . mysqli_connect_error());
// }
require ('config.php');

// Fetch data based on user input
if (isset($_GET['query'])) {
  $query = $_GET['query'];
  //echo $query;
    //   $sql = "SELECT shops.name 
    //           FROM shops
    //           INNER JOIN services ON shops.service_id = services.id
    //           WHERE services.name LIKE '%$query%'";
  // $sql = "SELECT name  FROM arena WHERE address LIKE '%$query%'";
  $sql = "SELECT address  FROM `arena` WHERE address LIKE '%$query%'";
  $result = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['address'];
  }
  // Return the JSON response
  echo json_encode($data);
}
?>