<?php  

session_start();
include "Utils/Util.php";

session_unset();
session_destroy();

$errorMessage = "logded out! ";
Util::redirect("login.php", "error", $errorMessage);