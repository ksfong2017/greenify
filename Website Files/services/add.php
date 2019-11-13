<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$link = mysqli_connect("localhost", "devepico_green", "sm;@P@rb82&7", "devepico_greenify", "3306");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "INSERT INTO data(type) VALUES ('". $_GET["type"] . "')";
if (mysqli_query($link, $sql)) {

    #echo "New record created successfully. Last inserted ID is: " . $last_id;

} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

?>
