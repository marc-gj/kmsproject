<?php

include '../../core/init.php';
	$item_t = $_POST['data'];
	//$item_t = sanitize($item_t);
	if (count($item_t)>1){
		$item_t = join("','",$item_t);
	}else{
		$item_t = implode($item_t);
	}
	$query = "SELECT meal_name, meal_number from meals WHERE (type IN ('$item_t'))";
	
	$response = mysqli_query($dbc,$query);
	if (!$response) {
		printf("Error: %s\n", mysqli_error($dbc));
		exit();
	}
	while($row = mysqli_fetch_assoc($response)){ 
		$meal_id = $row['meal_number'];
		$meal_name = $row['meal_name'];
		?>
		<div class = "module-small" data-meal = "meal" id="<?php echo $meal_id ?>" onclick="clickDiv($(this).attr('id'));">
			<div class = "w3-card-8 w3-dark-grey">
				<img src ="http://www.kfc.ca/menuImage.axd?Name=Streetwise1&Section=Streetwise&type=modal" class="w3-image">
				<div class ="w3-container w3-blue" style = ""><h6 class = "module_heading"><?php echo $meal_name; ?></h6></div>
			</div>
		</div>
		<?php
	}
?>
