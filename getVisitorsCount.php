<?php
$servername = "localhost";
$username = "id16983735_dbadmin";
$password = "JP3CnQ2K-vkD4NyH";
$dbname = "id16983735_thoughtwaves";


$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    $connection->close();
    error_log("Connection failed: " . $conn->connect_error, 0);
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