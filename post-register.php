
<?php
require_once "db_config.php";


if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	exit(header("Location: register.php?result=errorRegisterGeneric"));
}
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	exit(header("Location: register.php?result=errorRegisterGeneric"));
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit(header("Location: register.php?result=errorEmailInvalid"));
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
	exit(header("Location: register.php?result=errorUsernameInvalid"));
}
if (strlen($_POST['password']) > 32 || strlen($_POST['password']) < 5) {
	exit(header("Location: register.php?result=errorPasswordLength"));
}
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		exit(header("Location: register.php?result=errorUsernameExists"));
	} else {
    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, ip, email, rank) VALUES (?, ?, ?, ?, ?)')) {
    	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$defaultRank = 'user';
			$ip = $_SERVER['REMOTE_ADDR'];
      $stmt->bind_param('sssss', $_POST['username'], $password, $ip, $_POST['email'], $defaultRank);
      $stmt->execute();


// Copy default user images to new user
			$username = $_POST['username'];

// 256
			$file256 = 'uploads/default_256.png';
			$newfile256 = "uploads/256_$username.png";
			copy($file256, $newfile256);

// 128
			$file128 = 'uploads/default_128.png';
			$newfile128 = "uploads/128_$username.png";
			copy($file128, $newfile128);
// 64
			$file64 = 'uploads/default_64.png';
			$newfile64 = "uploads/64_$username.png";
			copy($file64, $newfile64);

			exit(header("Location: login.php?result=success"));

    } else {
			exit(header("Location: register.php?result=errorRegisterGeneric"));
    }	}
	$stmt->close();
} else {
	exit(header("Location: register.php?result=errorRegisterGeneric"));
}
$con->close();
?>
