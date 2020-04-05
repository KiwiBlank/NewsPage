<?php



session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require_once "db_config.php";

$stmt = $con->prepare('SELECT username, rank FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $rank);
$stmt->fetch();
$stmt->close();

$adminRanks = array('admin','technician');

			if (!in_array($rank, $adminRanks))
{
	exit(header("Location: postnews.php?result=fail"));
}

if (strlen($_POST['title']) > 64) {
  exit(header("Location: postnews.php?result=titleerror"));
}


      $date = date('Y-m-d H:i:s');
      $stmt = $con->prepare('INSERT INTO news (title, text, author, date) VALUES (?, ?, ?, ?)');
      $stmt->bind_param('ssss', $_POST['title'], $_POST['text'], $username, $date);
      $stmt->execute();
	$stmt->close();
$con->close();

header("Location: postnews.php?result=success");

//header('Location: news.php');
?>
