<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 
?>

	
	<?php 
	if (isset($_SESSION['user_id'])){
		include 'php/meals/create_meal_item/item_creator.php';
	} else{
		echo 'Not logged in';
	}
	?>
<?php include 'includes/overall/footer.php'; ?>