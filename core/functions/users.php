<?php

function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}

function user_exists($username){
	global $dbc;
	$username = sanitize($username);
	$query = mysqli_query($dbc,"SELECT COUNT(user_id) AS result FROM users WHERE username = '$username'");
	$row = mysqli_fetch_assoc($query);
	return ($row['result']==='1') ? true : false;
}

function user_active($username){
	global $dbc;
	$username = sanitize($username);
	$query = mysqli_query($dbc,"SELECT COUNT(user_id) AS result FROM users WHERE username = '$username' AND active = 1");
	$row = mysqli_fetch_assoc($query);
	return ($row['result']==='1') ? true : false;
}

function user_id_from_username($username){
	global $dbc;
	$username = sanitize($username);
	$query = mysqli_query($dbc, "SELECT user_id AS result FROM users WHERE username = '$username'");
	$row = mysqli_fetch_assoc($query);
	return $row['result'];
}


function login($username, $password){
	global $dbc;
	$user_id = user_id_from_username($username);
	$query = mysqli_query($dbc,"SELECT password AS passhash FROM users WHERE username = '$username'");
	$row = mysqli_fetch_assoc($query);
	$username = sanitize($username);
	$password = password_verify($password,$row['passhash']);
	$query = mysqli_query($dbc,"SELECT COUNT(user_id) AS result FROM users WHERE username = '$username'");
	$row = mysqli_fetch_assoc($query);
	return ($row['result'] === '1' && $password == true) ? $user_id : false;
}


function register(){
	
}
?>

