<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";


$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    $connection->close();
    error_log("Connection failed: " . $connection->connect_error, 0);
    echo 0;
}

$sql = "SELECT COUNT(id) 'count' FROM testtube_experiment_result";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["count"];
}
else {
    echo 0;
}

$connection->close();
?>