<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 
?>
	
	
	<?php 
	if (logged_in()){
		include 'php/stock/seasoning_added.php';
	} else{
		echo 'Not logged in';
	}
	?>
	
<?php include 'includes/overall/footer.php'; ?>