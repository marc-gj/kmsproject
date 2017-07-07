<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 

if (logged_in()){
	include 'php/sushi/create_sushi_dish/sushi_builder.php';
} else{
	echo 'Not logged in';
}
	
include 'includes/overall/footer.php'; 