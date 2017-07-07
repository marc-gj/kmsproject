<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 
?>
	
	<?php 
	if (logged_in()){
		include 'php/meals/edit_view_meal_item/view_item.php';
	} else{
		echo 'Not logged in';
	}
	?>
	
<?php include 'includes/overall/footer.php'; ?>
