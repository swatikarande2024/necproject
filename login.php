<?php
	include "Utils/Validation.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

</head>
<body>
    <div class="wrapper">
    	<div class="form-holder">
    		<h2>SIGN IN</h2>
    		<?php 
                if (isset($_GET['error'])) { ?>
                	<p class="error"><?=Validation::clean($_GET['error'])?></p>
            <?php } ?>

    		<form id="loginForm" class="form" action="Action/login.php" method="POST">

    			<div class="form-group">
    				<input type="text" id="username" name="username" placeholder="User name" required>
    			</div>
    			<div class="form-group">
    				<input type="password" id="password" name="password" placeholder="Password" required>
    			</div>
    			<div class="form-group">
    				<button type="submit" class="btn btn-primary">Login</button>
    			</div>
    			<div class="form-group">
    				<a href="signup.php">Sign Up</a>
    			</div>
    		</form>
    	</div>
    </div>

	<script>
        $(document).ready(function () {
		
            $("#loginForm").validate({				
                rules: {
                    username: "required",
                    password: "required"
                },
                messages: {
                    username: "Please enter your username",
                    password: "Please enter your password"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

</body>
</html>