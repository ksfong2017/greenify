<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$link = mysqli_connect("localhost", "devepico_green", "sm;@P@rb82&7", "devepico_greenify", "3306");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = mysqli_query($link, "SELECT COUNT(*) AS mycount FROM data WHERE type = '".$_GET["type"]."'");
$id = 0;
if (!$query)
{
    die('Error: ' . mysqli_error($query));
}

$res = mysqli_fetch_object($query);

echo $count = $res->mycount;


?>
