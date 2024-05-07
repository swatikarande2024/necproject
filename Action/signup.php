<?php

include "../Utils/Validation.php";
include "../Utils/Util.php";
include "../Database.php";
include "../Models/User.php";

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {

	$user_name   = Validation::clean($_POST["username"]);
	$full_name   = Validation::clean($_POST["fullname"]);
	$email       = Validation::clean($_POST["email"]);
	
    $data = "fname=".$full_name."&uname=".$user_name."&email=".$email;

    if ( !Validation::name( $full_name ) ) {

    	$errorMessage = "Invalid full name";
	    Util::redirect("../signup.php", "error", $errorMessage, $data);

    }else if ( !Validation::username( $user_name ) ) {

    	$errorMessage = "Invalid user name";
	    Util::redirect("../signup.php", "error", $errorMessage, $data);

    }else if ( !Validation::email( $email ) ) {

    	$errorMessage = "Invalid email";
	    Util::redirect("../signup.php", "error", $errorMessage, $data);

    }else if( !Validation::password( $password ) ) {

    	$errorMessage = "Invalid Password";
	    Util::redirect("../signup.php", "error", $errorMessage, $data);

    }else if( !Validation::match( $password, $re_password ) ) {

    	$errorMessage = "Password and confirm password not match";
	    Util::redirect("../signup.php", "error", $errorMessage, $data);

    }else {

       $db   = new Database();
       $connection = $db->connect();
       $user = new User($connection);

       if( $user->is_username_unique( $user_name ) ) {

	       	// password hash
	       $password  = password_hash( $password, PASSWORD_DEFAULT );
	       $user_data = [$user_name, $password, $full_name, $email];
	       $result    = $user->insert( $user_data );

	       if ( $result ) {
				$successMessage = "Successfully registered!";
				Util::redirect( "../signup.php", "success", $successMessage );
	       } else {
				$errorMessage = "An error occurred";
				Util::redirect( "../signup.php", "error", $errorMessage, $data );
	       }

       } else {

			$errorMessage = "The username ( $user_name ) is already taken";
			Util::redirect( "../signup.php", "error", $errorMessage, $data );

       }
    }

} else {

	$errorMessage = "An error occurred";
	Util::redirect( "../signup.php", "error", $errorMessage );
}