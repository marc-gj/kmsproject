<?php
//include '../core/database/mysqli_connect.php';
//include '../core/functions/general.php';
include '../../core/init.php';
	$item_t = $_POST['data'];
	//$item_t = sanitize($item_t);
	if (count($item_t)>1){
		$item_t = join("','",$item_t);
	}else{
		$item_t = implode($item_t);
	}
	$query = "SELECT item_number, item_name, method FROM item_list WHERE item_type IN ('$item_t') ORDER BY item_name ASC";
	//$query['ingredients'] = "SELECT stock_item_number amount FROM ingredients WHERE item_number = 45";
	$response = mysqli_query($dbc,$query);
	//$response['ingredients'] = @mysqli_query($dbc,$query['ingredients']);
	if (!$response) {
		printf("Error: %s\n", mysqli_error($dbc));
		exit();
	}
	while($row = mysqli_fetch_assoc($response)){ 
		$item_id = $row['item_number'];
		$item_name = $row['item_name'];
		$method = $row['method'];
		?>
	
		<div class = "module-small" id="<?php echo $item_id ?>" onclick="clickDiv($(this).attr('id'));">
			<div class ="w3-container w3-blue" style = ""><h6 class = "module_heading"><?php echo $item_name; ?></h6></div>
			<div class = "w3-container w3-card-8 w3-dark-grey">
				<img src ="http://www.kfc.ca/menuImage.axd?Name=Streetwise1&Section=Streetwise&type=modal" class="w3-image">
				<?php  ?>
			</div>
		</div>
		<?php
	}

?>
