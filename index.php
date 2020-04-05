<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="css/foundation.min.css">



<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/foundation.min.js" type="text/javascript"></script>
<script src="js/sweetalert.funcs.js" type="text/javascript"></script>
<script src="sweetalert/sweetalert2.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
	</head>
	<body>

		<div class="top-bar">
		  <div class="top-bar-left">
		    <ul class="dropdown menu" data-dropdown-menu>
		      <li class="menu-text">Kiwi Blank</li>
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<?php if ($_SESSION['rank'] == 'admin' OR $_SESSION['rank'] == 'technician') {?>
					<li><a href="postnews.php"><i class="fas fa-plus-square"></i> Post News</a></li><?php } ?>
				  <li><a href="news.php"><i class="far fa-newspaper"></i> View News</a></li>
					<li><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
					<div class="top-bar-right">
				    <ul class="menu">
							<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				    </ul>
				  </div>

		    </ul>
		  </div>
		</div>



		<div class="row">
		    <div class="twelve columns text-center"><br>
					<h2>Home Page</h2>
					<p>Welcome back, <?=$_SESSION['name']?>!</p><br>
					<p>Check out the news for the latest info about the website.</p>
				</div>
		</div>

	</body>
</html>
<?php
if (isset($_GET['result'])) {

switch ($_GET['result']) {

	case "success":
		print '<script type="text/javascript">successLogin();</script>';
		break;
}



}
?>
