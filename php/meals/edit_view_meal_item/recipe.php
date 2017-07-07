<?php 
include '../../core/database/mysqli_connect.php';
include '../../core/functions/general.php';
if(isset($_POST['clicked'])){
	global $dbc;
	$clicked = $_POST['clicked'];
	$clicked = sanitize($clicked);
	$i = 0;
	$item_number = $clicked;
	$query = "
	SELECT
	  ingredients.amount,
	  stock.description,
	  stock.notes,
	  stock.measurement,
	  stock.price,
	  stock.unit_per_case,
	  stock.amount_per_unit,
	  item_list.item_name,
	  item_list.item_type,
	  item_list.created_by,
	  item_list.method
	FROM item_list
	JOIN ingredients
	  ON item_list.item_number = ingredients.item_number
	JOIN stock
	  ON ingredients.stock_item_number = stock.stock_item_number
	WHERE item_list.item_number = $item_number";
	$response = mysqli_query($dbc,$query);
	while($row = mysqli_fetch_assoc($response)){ 
		$item['price'][$i] = $row['price'];
		$item['unit_per_case'][$i] = $row['unit_per_case'];
		$item['amount_per_unit'][$i] = $row['amount_per_unit'];
		$item['item_name'] = $row['item_name'];
		$item['description'][$i] = $row['description'];
		$item['notes'][$i] = $row['notes'];
		$item['amount'][$i] = $row['amount'];
		$item['item_type'] = $row['item_type'];
		$item['created_by'] = $row['created_by'];
		$item['method'] = $row['method'];
		$item['measurement'][$i] = $row['measurement'];
		$i++;
	}
	load_recipe();
}	
function load_recipe(){ 
	$i = 0;
	global $item;
?>	
	<div id = "recipe" class = "module">
		<div class ="w3-container w3-blue w3-padding"><h1 class = "module_heading"><?php echo $item['item_name']; ?></h1><div class = "w3-xlarge module_close" id = "close"><i class = "fa fa-close"></i></div></div>
		<div class = "w3-container w3-card-8 w3-dark-grey w3-padding">
			<p id = "serving-adjuster">Serving Size: <input onkeyup = "servSize()" onclick = "servSize()" type = "number" name = "serv" class = "w3-input" id = "serv"></p>
			<div class = "w3-half">
				<p>Created by Chef: <?php echo $item['created_by']; ?></p>
				<p>Cost: 
				<table id = "measurement-table" class = "w3-table">
					<tr>
						<th>Ingredients</th>
						<th>Amount</th>
						<th>Cost</th>
					</tr>
					<?php foreach($item['description'] as $key){ ?>
					<tr>
						<td><?php echo $key," ", $item['notes'][$i]; ?></td>
						<td><span class = "tester" value = "<?php echo $item['amount'][$i]; ?>"><?php echo $item['amount'][$i]; ?></span> <?php echo $item['measurement'][$i];?></td>
						<td><span class = "tester" value = "<?php echo $item['amount'][$i]*($item['price'][$i]/($item['unit_per_case'][$i]*$item['amount_per_unit'])); $i++; ?>">Test</span></td>
					</tr>
				<?php } ?>
				</table>
			</div>
			<div class = "w3-half">
				<img id = "recipe-img" src="http://www.kfc.ca/menuImage.axd?Name=Streetwise1&Section=Streetwise&type=modal" class = "w3-card-8 w3-image">
			</div>
			<fieldset id = "recipe-method">
				<legend>Method</legend>
				<?php echo $item['method'];  ?>
			</fieldset>
		</div>
	</div>
	
<?php 
} 
?>
