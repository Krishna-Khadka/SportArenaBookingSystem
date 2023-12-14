<?php
 
//define('ROOT','http://localhost/ArenaAce/');
$con = mysqli_connect('localhost', 'root', '', 'sfbs');
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// else{
//     echo "Connected Successfully.";
// }
?>