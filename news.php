<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require_once "db_config.php";

if (!isset($_GET['amount'])) {
	$_GET['amount'] = 3;
}


if (!is_numeric($_GET['amount'])) {
	$newsamount = 3;
}

if (isset($_GET['amount'])) {
	if (!is_numeric($_GET['amount'])) {
		$newsamount = 3;
	} else {
	$newsamount = $_GET['amount'];
}
} else {
	$newsamount = 3;
}
if ($newsamount < 1) {
	$newsamount = 3;
}



$stmt = $con->prepare("SELECT id, title, date, author, text FROM news ORDER BY date DESC LIMIT $newsamount");
$stmt->execute();
$res = $stmt->get_result();



$stmt->close();
$con->close();
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Latest News</title>
		<link rel="stylesheet" href="css/fontawesome.all.min.css">
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
			<center><h2>Latest News</h2></center>
			<br>
      <div class="news-box">
				<center>
        <?php
        while ($row = $res->fetch_array()) {
        $author = $row['author'];
        $date = $row['date'];
        $title = $row['title'];
        $text = $row['text'];
        $id = $row['id'];

				if (strlen($text) > 125) {
					$stringCut = substr($text, 0, 125);
$endPoint = strrpos($stringCut, ' ');
$text = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

}
$text = nl2br(str_replace(" ", "&nbsp;", $text));

//if the string doesn't contain any space then it will cut without word basis.
$text .=
				<<<CODE
... <br><a href="readnews.php?newsid=$id">Read More</a>
CODE;
        echo<<<CODE
        <div class="news"><br>
            <h2><a href="readnews.php?newsid=$id">$title</a></h2>
						<p class="font-italic">$date CET by $author</p><br>
            <p>$text</p>
        </div>
CODE;
        }
        ?>
			</center>
      </div>
		</div><br>
		<center><a href="news.php?amount=<?php echo $newsamount + 3?>">View Older</a></center>
	</body>
</html>
