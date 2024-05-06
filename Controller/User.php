<?php 
include "Models/User.php";
include "Database.php";

$db = new Database();
$db_connection = $db->connect();
$user = new User($db_connection);