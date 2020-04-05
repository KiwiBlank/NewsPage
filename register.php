<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="css/foundation.min.css">



<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/foundation.min.js" type="text/javascript"></script>
<script src="js/sweetalert.funcs.js" type="text/javascript"></script>
<script src="sweetalert/sweetalert2.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
	</head>
	<body>
<div class="register">
			<h1>Register</h1>
			<form action="post-register.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<input type="submit" value="Register">
			</form>
		</div>
	</body>
</html>

<?php
if (isset($_GET['result'])) {

switch ($_GET['result']) {


	case "errorUsernameExists":
		print '<script type="text/javascript">errorUsernameExists();</script>';
		break;
	case "errorPasswordLength":
	  print '<script type="text/javascript">errorPasswordLength();</script>';
		break;
	case "errorUsernameInvalid":
		print '<script type="text/javascript">errorUsernameInvalid();</script>';
	  break;
	case "errorEmailInvalid":
		print '<script type="text/javascript">errorEmailInvalid();</script>';
		break;
	case "errorRegisterGeneric":
		print '<script type="text/javascript">errorRegisterGeneric();</script>';
		break;
}



}
?>
