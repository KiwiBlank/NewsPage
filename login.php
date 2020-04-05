<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="css/foundation.min.css">



<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/foundation.min.js" type="text/javascript"></script>
<script src="js/sweetalert.funcs.js" type="text/javascript"></script>
<script src="sweetalert/sweetalert2.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
	</head>
	<body>
		<div class="col-xs-1 text-center">
		<form action="post-login.php" method="post">
  <div class="col order-12">
    <label for="username">
			<i class="fas fa-user"></i>
			Username
		</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
  </div>
  <div class="col order-12">
    <label for="password">
			<i class="fas fa-lock"></i>
			Password
		</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>
	<div>
 <input id="checkbox" type="checkbox" name="remember" value="true"><label for="checkbox">Remember Me</label>
</div>
</br>
<button type="submit" class="button">Submit</button>
</form>
</div>
</body>
</html>
<?php
if (isset($_GET['result'])) {

switch ($_GET['result']) {

	case "success":
		print '<script type="text/javascript">successRegistered();</script>';
		break;
	case "errorLoginFillOut":
	  print '<script type="text/javascript">errorLoginFillOut();</script>';
	  break;
	case "errorLoginPassword":
		print '<script type="text/javascript">errorLoginPassword();</script>';
		break;
	case "errorLoginUsername":
		print '<script type="text/javascript">errorLoginUsername();</script>';
		break;
	case "infoLogOut":
  	print '<script type="text/javascript">infoLogOut();</script>';
		break;
}



}
?>
