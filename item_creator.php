<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 


	if (logged_in()){
		include 'php/meals/create_meal_item/item_creator.php';
	} else{
		echo 'Not logged in yo';
	}

	
include 'includes/overall/footer.php';
?>