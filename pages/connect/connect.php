<?php
function connect(){
  $servername = "localhost";
  $database = "cms";
  $username = "root";
  $password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("thất bại: " . $conn->connect_error);
};
return $conn;
};

