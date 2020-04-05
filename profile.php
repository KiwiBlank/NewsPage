<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require_once "db_config.php";

$stmt = $con->prepare('SELECT password, email, rank, username FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $rank, $username);
$stmt->fetch();
$stmt->close();
$con->close();

$adminRanks = array('admin','technician')
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
					<?php if ($rank == 'admin' OR $rank == 'technician') {?>
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
			<center><h2>Your Profile</h2></center>
			<br>
			<div><?php
			$currentTime = time();

			if (file_exists("uploads/256_${username}.png")) {
				echo<<<CODE
<img src="uploads/256_$username.png?$currentTime">
CODE;

			}
			if (file_exists("uploads/256_${username}.jpeg")) {
				echo<<<CODE
<img src="uploads/256_$username.jpeg?$currentTime">
CODE;

			}
			if (file_exists("uploads/256_${username}.jpg")) {
				echo<<<CODE
<img src="uploads/256_$username.jpg?$currentTime">
CODE;

}
			if (file_exists("uploads/256_${username}.gif")) {
				echo<<<CODE
<img src="uploads/256_$username.gif?$currentTime">
CODE;

			}

?>
<div class="grid-x">
<div class="cell small-6">
<form action="uploadprofileimg.php" method="post" enctype="multipart/form-data">
						Select image to upload (Preferred 256x256):<br>
						<input type="file" name="fileToUpload" id="fileToUpload"><br>
						<input type="submit" value="Upload Image" name="submit">
				</form><br>
				<p>Your account details are below:</p>
				<table>
					<?php
							if (in_array($rank, $adminRanks))  {
					?>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Rank:</td>
						<td><?=$rank?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<?php } else { ?>
						<tr>
							<td>Username:</td>
							<td><?=$username?></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><?=$email?></td>
						</tr>
					<?php } ?>
					<tr>
					</tr>
				</table><br>

			</div>
		</div></div>
	</body>
</html>
<div class="cell small-6"></div>
</div>
<?php
if (isset($_GET['result'])) {

switch ($_GET['result']) {

	case "success":
		print '<script type="text/javascript">successImageUpload();</script>';
		break;
	case "errorImageUpload":
		print '<script type="text/javascript">errorImageUpload();</script>';
		break;
}



}
?>
