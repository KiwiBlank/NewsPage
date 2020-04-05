<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require_once "db_config.php";

$stmt = $con->prepare('SELECT rank FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($rank);
$stmt->fetch();
$stmt->close();
$con->close();

$adminRanks = array('admin','technician');

if (!in_array($rank, $adminRanks))
{

	header('Location: index.php');
	exit;
}



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
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
		<div class="content">
			<br>
			<center><h2>Post News</h2></center>
			<br>
			<form action="post-news.php" method="post">
					<textarea cols="32" class="form-control" rows="2" name="title" id="title">Title</textarea>
					<textarea cols="120" class="form-control" rows="12" name="text" id="text">Text</textarea>
					<center><button type="submit" class="button">Submit</button></center>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
if (isset($_GET['result'])) {

switch ($_GET['result']) {

	case "success":
		print '<script type="text/javascript">successPostNews();</script>';
		break;
	case "fail":
		print '<script type="text/javascript">errorNoAdmin();</script>';
		break;
	case "titleerror":
	  print '<script type="text/javascript">errorLengthNews();</script>';
		break;
}



}
?>
