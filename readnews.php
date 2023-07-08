<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require_once "db_config.php";

$stmt = $con->prepare('SELECT id, title, date, author, text FROM news WHERE id = ?');
$stmt->bind_param('i', $_GET['newsid']);
$stmt->execute();
$res = $stmt->get_result();
$stmt->close();
$con->close();

if ($res->num_rows == 0) {
	exit('Invalid ID');
}
$row = $res->fetch_array();

$author = $row['author'];
$date = $row['date'];
$title = $row['title'];
$text = $row['text'];
$id = $row['id'];
?>




<html>

<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
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
				<?php if ($_SESSION['rank'] == 'admin' or $_SESSION['rank'] == 'technician') { ?>
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
		<center>
			<h2><?= $title ?></h2>
		</center>
		<br>
		<div class="news-box">
			<center>
				<?php




				$text = wordwrap($text, 150, "<br/>", true); // or use <br/>
				$text = nl2br(str_replace(" ", "&nbsp;", $text));

				echo <<<CODE
        <div class="news"><br>
            <p>$text</p>
            <p class="font-italic">published on $date by $author</p><br><hr>
        </div>
CODE;
				?>
			</center>
		</div>
	</div>
</body>

</html>
















</div>
</body>

</html>