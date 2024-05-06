<?php  
session_start();

include "../Utils/Validation.php";
include "../Utils/Util.php";
include "../Database.php";
include "../Models/User.php";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {

	$user_name = Validation::clean($_POST["username"]);
	$password  = Validation::clean($_POST["password"]);
    
   if ( !Validation::username( $user_name ) ) {

    	$errorMessage = "Invalid user name";
	   Util::redirect("../login.php", "error", $errorMessage);
      
   } else if( !Validation::password( $password ) ) {

    	$errorMessage = "Invalid Password";
	   Util::redirect( "../login.php", "error", $errorMessage );

   } else {

      $db         = new Database();
      $connection = $db->connect();
      $user       = new User( $connection );
      $auth       = $user->auth( $user_name, $password );

      if ( $auth ) {

         $user_data             = $user->getUser();
         $_SESSION['user_name'] = $user_data['user_name'];
         $_SESSION['user_id']   = $user_data['user_id'];

         $successMessage = "logged in!";
         Util::redirect("../index.php", "success", $successMessage);

      } else {

         $errorMessage = "Incorrect username or password";
         Util::redirect("../login.php", "error", $errorMessage);  
      }      
   }

} else {
      $errorMessage = "An error occurred";
      Util::redirect("../login.php", "error", $errorMessage);
}