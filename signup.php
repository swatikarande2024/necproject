<?php 
include "Utils/Validation.php";

$fname = $uname = $email ="";
if (isset($_GET["fname"])) {
	$fname = $_GET["fname"];
}
if (isset($_GET["uname"])) {
	$uname = $_GET["uname"];
}
if (isset($_GET["email"])) {
	$email = $_GET["email"];
}
 ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
    	<div class="form-holder">
    		<h2>Create New Account</h2>
    		<?php 
                if (isset($_GET['error'])) { ?>
                	<p class="error"><?=Validation::clean($_GET['error'])?></p>
            <?php } ?>
            <?php 
                if (isset($_GET['success'])) { ?>
                	<p class="success"><?=Validation::clean($_GET['success'])?></p>
            <?php } ?>
    		
    		<form id="registrationForm" class="form" action="Action/signup.php" method="POST">

    			<div class="form-group">
    				<input type="text" id="fullname" name="fullname" placeholder="Full name" value="<?=$fname?>">
    			</div>
    			<div class="form-group">
    				<input type="text" id="username" name="username" placeholder="User name" value="<?=$uname?>" required>
    			</div>
    			<div class="form-group">
    				<input type="text" id="email" name="email" placeholder="Email" value="<?=$email?>" required>
    			</div>
    			<div class="form-group">
    				<input type="password" id="password" name="password" placeholder="Password" required>
    			</div>
    			<div class="form-group">
    				<input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
    			</div>
    			<div class="form-group">
    				<button type="submit">Sign Up</button>
    			</div>
    			<div class="form-group">
    				<a href="login.php">Sign In</a>
    			</div>
    		</form>
    	</div>
    </div>

	<script>
        $(document).ready(function () {
			
            $("#registrationForm").validate({
                rules: {
                    fullname: "required",
                    username: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    fullname: "Please enter your fullname",
                    username: "Please enter your username",
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    confirmPassword: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

</body>
</html>