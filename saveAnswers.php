<?php
function saveAnswer($professionGroup, $profession, $ageGroup, $answer, $feedback) {
	$servername = "localhost";
	$username = "id16983735_dbadmin";
	$password = "JP3CnQ2K-vkD4NyH";
	$dbname = "id16983735_thoughtwaves";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        $connection->close();
        error_log("Connection failed: " . $conn->connect_error, 0);
        return FALSE;
    }

    $sql = "INSERT INTO testtube_experiment_result (profession_group, profession, age_group, answer, feedback)
    VALUES ('". $professionGroup ."', '". $profession ."', '". $ageGroup ."', '".$answer."', '".$feedback."')";

    if ($connection->query($sql) === TRUE) {
        $connection->close();
        return TRUE;
    }
    else {
        error_log("Error: " . $sql . "\n". $conn->error);
        $connection->close();
        return FALSE;
    }
}
         
$result = array();
$result['professionGroup'] = TRUE;
$result['profession'] = TRUE;
$result['age'] = TRUE;
$result['views'] = TRUE;
$result['feedback'] = TRUE;

$professionGroups = array("math", "phy", "chem", "bio", "cs", "eng", "mba", "fin", "oth");
$ageGroups = array("15", "20", "25", "30", "40", "60", "100");
$professionGroup = "";
$profession = "";
$ageGroup = "";
$answer = "";
$feedback = "";

if (isset($_POST["professionGroup"])) {
    $professionGroup = htmlspecialchars(trim($_POST["professionGroup"], " "));
    if (!in_array($professionGroup, $professionGroups)) {
        $result['professionGroup'] = FALSE;
    }
}
else {
    $result['professionGroup'] = FALSE;
}

if (isset($_POST["profession"]) && $_POST["profession"] != "") {
    $profession = htmlspecialchars(trim($_POST["profession"], " "));
    $length = strlen($profession);
    if ($length < 2 || $length > 40) {
        $result['profession'] = FALSE;
    }
}
else {
    $result['profession'] = FALSE;
}

if (isset($_POST["age"])) {
    $ageGroup = htmlspecialchars(trim($_POST["age"], " "));
    if (!in_array($ageGroup, $ageGroups)) {
        $result['age'] = FALSE;
    }
}
else {
    $result['age'] = FALSE;
}

if (isset($_POST["views"]) && $_POST["views"] != "") {
    $answer = htmlspecialchars(trim($_POST["views"], " "));
    $length = strlen($answer);
    if ($length < 2 || $length > 700) {
        $result['views'] = FALSE;
    }
}
else {
    $result['views'] = FALSE;
}

if (isset($_POST["feedback"])) {
    $feedback = htmlspecialchars(trim($_POST["feedback"], " "));
    $length = strlen($feedback);
    if ($length < 2 || $length > 200) {
        $result['feedback'] = FALSE;
    }
}

$result['validationError'] = $result['professionGroup'] && $result['profession'] && $result['age'] && $result['views'] && $result['feedback'];
$result['success'] = FALSE;

if (!$result['validationError']) {
    $result['success'] = saveAnswer($professionGroup, $profession, $ageGroup, $answer, $feedback);
}

echo json_encode($result);
?>