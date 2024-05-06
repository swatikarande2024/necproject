<?php  

session_start();
include "Utils/Util.php";

session_unset();
session_destroy();

$errorMessage = "logdded out! ";
Util::redirect("login.php", "error", $errorMessage);