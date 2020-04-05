<?php


require_once "db_config.php";


if ( !isset($_POST['username'], $_POST['password']) ) {
	exit(header("Location: login.php?result=errorLoginFillOut"));
}




if ($stmt = $con->prepare('SELECT id, password, rank FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
  if ($stmt->num_rows > 0) {
  	$stmt->bind_result($id, $password, $rank);
  	$stmt->fetch();
  	if (password_verify($_POST['password'], $password)) {

			if (isset($_POST['remember']) && $_POST['remember'] == 'true')
			{
				session_set_cookie_params(43200); // Logout user after twelve hours
				session_start();
	  		session_regenerate_id();
			}
			else
			{
				session_set_cookie_params(3600); // Logout user after one hour
				session_start();
	  		session_regenerate_id();
			}

  		$_SESSION['loggedin'] = TRUE;
  		$_SESSION['name'] = $_POST['username'];
  		$_SESSION['id'] = $id;
			$_SESSION['rank'] = $rank;
			exit(header("Location: index.php?result=success"));
  	} else {
			exit(header("Location: login.php?result=errorLoginPassword"));
  	}
  } else {
		exit(header("Location: login.php?result=errorLoginUsername"));
  }

	$stmt->close();
}
?>
