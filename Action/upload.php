<?php

include "../Utils/Validation.php";
include "../Utils/Util.php";
include "../Database.php";
include "../Models/User.php";

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    $uploadDir        = "../UploadedFiles/";
    $uploadedFile     = $_FILES["document"]["tmp_name"];
    $originalFileName = $_FILES["document"]["name"];
    $fileExtension    = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $newFileName      = uniqid().".".$fileExtension;
    $maxsize          = 2097152;

    if(( $_FILES['uploaded_file']['size'] >= $maxsize )) {
        $errorMessage = "File too large. File must be less than 2 megabytes.";
	    Util::redirect( "../index.php", "error", $errorMessage );
    }

    $allowedExtensions = array( "pdf", "png", "jpeg", "jpg" );
    if ( !in_array( $fileExtension, $allowedExtensions ) ) {
    
        $errorMessage = "Invalid file type. Please upload a PDF, PNG, JPEG, or JPG file.";
	    Util::redirect( "../index.php", "error", $errorMessage );

    } else {
        if ( move_uploaded_file( $uploadedFile, $uploadDir.$newFileName ) ) {
           
            $successMessage = "Form submitted successfully!<br> Uploaded File: ".$newFileName."<br>";
            Util::redirect( "../index.php", "success", $successMessage );
            
        } else {
       
            $errorMessage = "Error uploading file.";
            Util::redirect( "../index.php", "error", $errorMessage );
        }
    }
}
?>