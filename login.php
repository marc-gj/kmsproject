<?php
include 'core/init.php';
include 'includes/overall/header.php';


if (!empty($_POST)){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	
	if (empty($username) || empty($password)){
		$errors[] = 'You need to enter a username and password';
	} else if(user_exists($username) === false){
		$errors[] = 'We can\'t find that user';
	} else if(user_active($username) === false){
		$errors[] = 'Your account is not active. Contact you Systems Administrator';
	} else{
		$login = login($username, $password);
		if(!$login){
			$errors[] = 'That username/password combination is incorrect';
		}
		else {
			echo 'Logged in';
			$_SESSION['user_id'] = $login;//set the user session
			header("Location: index.php");
			exit();
		}	
	}
	
	
	print_r($errors);
}
include 'includes/overall/footer.php';
?>