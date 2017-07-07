<?php 
include '../../../core/database/mysqli_connect.php';
include '../../../core/functions/general.php';
if(isset($_POST['clicked'])){
	global $dbc;
	$clicked = $_POST['clicked'];
	$clicked = sanitize($clicked);
	$i = 0;
	$meal_number = $clicked;
	$query = "
	SELECT
		meals.meal_name,
		meals.container_size,
		meals.cup_size,
		meals.cup_amt,
		item_list.item_name,
		item_list.method,
		item_list.item_number
	FROM meals
	JOIN meal_items
		ON meals.meal_number = meal_items.meal_number
	JOIN item_list
		ON meal_items.item_number = item_list.item_number
	WHERE
	meals.meal_number = $meal_number";
	
	$response = mysqli_query($dbc,$query);
	while($row = mysqli_fetch_assoc($response)){ 
		$meal['meal_name'] = $row['meal_name'];
		$meal['container_size'] = $row['container_size'];
		$meal['cup_amt'] = $row['cup_amt'];
		$meal['cup_size'] = $row['cup_size'];
		$item['item_name'][$i] = $row['item_name'];
		$item['method'][$i] = $row['method'];
		$item['item_number'][$i] = $row['item_number'];
		$i++;
	}
	
	load_recipe($dbc);
}

function load_ingredients($item_number,$dbc){
	$i=0;
	$item_cost_total = 0;
	$query = "
	SELECT
	  ingredients.amount,
	  stock.description,
	  stock.notes,
	  stock.measurement,
	  stock.unit_per_case,
	  stock.amount_per_unit,
	  stock.price
	FROM ingredients
	JOIN stock
	  ON ingredients.stock_item_number = stock.stock_item_number
	WHERE ingredients.item_number = $item_number";
	
	$response = mysqli_query($dbc,$query);
	while($row = mysqli_fetch_assoc($response)){ 
		$ingredient['amount'][$i] = $row['amount'];
		$stock['description'][$i] = $row['description'];
		$stock['notes'][$i] = $row['notes'];
		$stock['measurement'][$i] = $row['measurement'];
		$stock['unit_per_case'][$i] = $row['unit_per_case'];
		$stock['amount_per_unit'][$i] = $row['amount_per_unit'];
		$stock['price'][$i] = $row['price'];
		$i++;
	}
	$i=0;
	foreach($stock['description'] as $key){?>
		<tr>
			<td><?php echo $stock['description'][$i], " ", $stock['notes'][$i];?></td>
			<td><span class = "tester" value = "<?php echo $ingredient['amount'][$i]; ?>"><?php echo $ingredient['amount'][$i]; ?></span> <?php echo $stock['measurement'][$i];?></td>
			<td>$<span class = "tester" value = "<?php $item_cost = $ingredient['amount'][$i]*($stock['price'][$i]/($stock['unit_per_case'][$i]*$stock['amount_per_unit'][$i])); $item_cost_total+=$item_cost; echo $item_cost;?>"><?php echo number_format((float)$item_cost,2,'.',''); ?></span></td>
		</tr>
		<?php $i++; ?>
	<?php } ?>
	<tr>
		<td><b>Total Cost</b></td>
		<td>
		<td><b>$<span class = "tester itemTotalCost" data-cost = "<?php echo $item_cost_total; ?>" value = "<?php echo $item_cost_total; ?>"><?php echo number_format((float)$item_cost_total,2,'.',''); ?></span></b></td> 
	</tr><?php
	}

function load_recipe($dbc){
	$i = 0;
	$cup_cost = 0;
	$container_cost = 0;
	global $meal;
	global $item;
	switch ($meal['cup_size']){
		case "1oz":
			$cup_cost = 0.13+0.12;
			break;
		case "2oz":
			$cup_cost = 0.13+0.12;
			break;
		case "4oz":
			$cup_cost = 0.16+0.18;
			break;
	}
	switch ($meal['container_size']){
		case "Large":
			$container_cost = 3;
			break;
		case "Medium":
			$container_cost = 2;
			break;
		case "Salad":
			$container_cost = 2;
			break;
		case "Fruit":
			$container_cost = 2; //update to 1.6 from the new batch
			break;
		case "Soup":
			$container_cost = 2.866;
		break;
	}
?>	
	<div id = "recipe" class = "module">
		<div class ="w3-container w3-blue w3-padding"><h1 class = "module_heading"><?php echo $meal['meal_name']; ?></h1><div class = "w3-xlarge module_close" id = "close"><i class = "fa fa-close"></i></div></div>
		<div class = "w3-container w3-card-8 w3-dark-grey w3-padding">
			<p id = "serving-adjuster">Serving Size: <input onkeyup = "servSize()" onclick = "servSize()" type = "number" name = "serv" class = "w3-input" id = "serv"></p>
			<div>
				<p>Container Size: <span id = "container_cost" data-cost = "<?php echo $container_cost; ?>"></span><?php echo $meal['container_size']; ?></p>
				<p>Cup Size: <span id = "cup_cost" data-cost = "<?php echo $cup_cost; ?>"><?php echo $meal['cup_size']; ?></span></p>
				<p># of Cups: <span id = "cup_amt" data-cost = "<?php echo $meal['cup_amt']; ?>"><?php echo $meal['cup_amt']; ?></span></p>
				<b><p>Meal Cost: $<span id = "mealTotalCost"></span></p></B>
				<?php foreach($item['item_name'] as $Key){ ?>
				<div class = "w3-row">
				<div class ="module" id = "<?php echo $item['item_number'][$i] ?>">
					<div class="w3-container w3-blue showHide"><h5><?php echo $Key; ?></h5></div>
					<div class = "w3-container w3-card-8 w3-dark-grey w3-padding">
						<table id = "measurement-table" class = "w3-table w3-large w3-hoverable">
							<tr>
								<th>Ingredients</th>
								<th>Amount</th>
								<th>Cost</th>
							</tr>
								<?php load_ingredients($item['item_number'][$i],$dbc); ?>
						</table>
						<fieldset id = "recipe-method">
							<legend>Method</legend>
							<?php echo $item['method'][$i]; $i++;  ?>
						</fieldset>
						</div>
					</div>
					</div>
				<?php } ?>
			</div>
			<script type="text/javascript">
					var totalCost = 0;
					var cupAmt = $("#cup_amt").data("cost");
					var cupCost = $("#cup_cost").data("cost");
					var containerCost = $("#container_cost").data("cost");
					$(".itemTotalCost").each(function(i,obj){
						totalCost += $(this).data("cost");
					});
					totalCost += cupAmt*cupCost;
					totalCost += containerCost;
					$("#mealTotalCost").text(parseFloat(Math.round(totalCost * 100) / 100).toFixed(2));
					$("#mealTotalCost").attr("value",parseFloat(Math.round(totalCost * 100) / 100).toFixed(2));
			</script>
		</div>
	</div>
	
<?php 
}
?>

