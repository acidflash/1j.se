<?php
$db_host = "localhost";
$db_user = "jonas";
$db_password = "Kattfarm83";
$db_name = "database";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("Anslutningsfel: " . $mysqli->connect_error);
}
?>
