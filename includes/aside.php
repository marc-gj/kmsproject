<aside id = "widget" class = "w3-container" style = "float:right; border-left:1px solid grey; min-width:250px;">
	<?php 
	if (logged_in() == true){
		echo 'Logged in ya';
		?>
		<br><br>
		<a href = "logout.php">
		<input type = "button" class = "w3-btn w3-light-grey w3-hover-green" value = "Logout" >
		</a>
		<?php
	} else{
		include 'includes/widgets/login.php';
	}
	?>
</aside>