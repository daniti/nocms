<?php
session_start();
require_once '../../admin-config.php';
if(isset($_POST['username']) && isset($_POST['password'])){
	if($_POST['username'] == ADMIN_USER && hash('sha256',$_POST['password'].SALT) == ADMIN_PWD){
		$_SESSION['loggedin'] = true;
		header('Location:index.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/fa/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="mega">
	<form action="login.php" class="login-form" method="post">
			<input type="text" name="username" class="input-cell" placeholder="username"><br>
			<input type="password" name="password" class="input-cell" placeholder="password"><br>
			<button type="submit" class="button">Login</button>
	</form>
</div>
</body>
</html>