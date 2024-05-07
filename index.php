<?php

session_start();
include "Utils/Util.php";
include "Utils/Validation.php";

if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])) {

	include "Controller/User.php";
    $user->init($_SESSION['user_id']);
    $user_data = $user->getUser();
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
</head>

<body>
   <div class="wrapper">
    	<div class="form-holder">

            <?php 
                if (isset($_GET['error']) ) { ?>
                	<p class="error"><?=Validation::clean($_GET['error'])?></p>
            <?php }  if ( isset($_GET['success'])) {?>
                    <p class="success"><?=Validation::clean($_GET['success'])?></p>
            <?php } ?>

    		<h2>Welcome <?=$user_data['full_name']?> !</h2>
    		
            <form class="form" id="necForm" enctype="multipart/form-data" action="Action/upload.php" method="POST">

                </br>
                    <div class="form-group">
                        <label for="document">Upload Document (PDF, PNG, JPEG, JPG):</label></br>
                        <p>File must be less than 2 megabytes.</p>
                        <input type="file" class="form-control-file" id="document" name="document" accept=".pdf, .png, .jpeg, .jpg" required>
                    </div>
                </br>

                <div class="form-group">
    				<button type="submit" action=>Upload Document</button>
    			</div>

                <div class="form-group">
    				<a href="logout.php">Logout</a>
    			</div>
    		</form>

    	</div>
    </div>
</body>
</html>

<?php }else { 
    $errorMessage = "First login ";
    Util::redirect("login.php", "error", $errorMessage);
} ?>