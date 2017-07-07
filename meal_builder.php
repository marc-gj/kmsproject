<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 

if (logged_in()){
	include 'php/meals/create_meal/meal_builder.php';
} else{
	echo 'Not logged in';
}
	
include 'includes/overall/footer.php'; 