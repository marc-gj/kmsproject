<?php 

$n=$_POST["daat"]; //counter for each ingredient in dropdown menu
$i=$_POST["increm"];
require_once('../../core/database/mysqli_connect.php');    
function ingMeasurement(){
	global $dbc;
	global $i;
	global $n;
	$query = "SELECT measurement FROM stock WHERE stock_item_number=$n";
	$response = @mysqli_query($dbc,$query);
	if (!$response) {
		printf("Error: %s\n", mysqli_error($dbc));
		exit();
	}
	$mes = mysqli_fetch_array($response);

	echo '<div id = "Placeholder'.$i.'">';
		echo '<p>';
		echo '<input type = "number" name = "ingredients[amount_'.$i.']" id = "amount'.$i.'" class="w3-input" placeholder = "0" value = "" required step = "0.01">';
		echo '<label for = "amount'.$i.'">Amount</label>';
		echo '</p>';
		switch ($mes['measurement']){
			case "g":
				echo '<fieldset>';
					echo '<legend>Mass</legend>';
					echo '<input type = "radio" name = "ingredients[ingMeas'.$i.']" id = "g'.$i.'" class="w3-radio" value = "g" required>';
					echo '<label class="w3-validate"> g </label>';
					echo '<input type = "radio" name = "ingredients[ingMeas'.$i.']" id = "oz'.$i.'" class="w3-radio" value = "oz" required>';
					echo '<label class="w3-validate"> oz </label>';
					echo '<input type = "radio" name = "ingredients[ingMeas'.$i.']" id = "lbm'.$i.'" class="w3-radio" value = "lbm" required>';
					echo '<label class="w3-validate"> lbm </label>';
				echo '</fieldset>';
				break;

			case "ml":
				echo '<fieldset>';
					echo '<legend>Volume</legend>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "ml'.$i.'" value = "ml" required>';
					echo '<label class="w3-validate"> ml </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "tsp'.$i.'" value = "tsp" required>';
					echo '<label class="w3-validate"> tsp </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "tbsp'.$i.'" value = "tbsp" required>';
					echo '<label class="w3-validate"> tbsp </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "foz'.$i.'" value = "foz" required>';
					echo '<label class="w3-validate"> foz </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "foz'.$i.'" value = "cup" required>';
					echo '<label class="w3-validate"> cup </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "foz'.$i.'" value = "quart" required>';
					echo '<label class="w3-validate"> quart </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "foz'.$i.'" value = "pint" required>';
					echo '<label class="w3-validate"> pint </label>';
					echo '<input class="w3-radio" type = "radio" name = "ingredients[ingMeas'.$i.']" id = "foz'.$i.'" value = "gal" required>';
					echo '<label class="w3-validate"> gal </label>';
				echo '</fieldset><br>';
				break;

			case "unit":
				echo '<fieldset>';
					echo '<legend>Unit</legend>';
					echo '<input type = "radio" name = "ingredients[ingMeas'.$i.']" id = "unit'.$i.'" class="w3-radio" value = "unit" required>';
					echo '<label class="w3-validate"> Unit (Ex. Lobster Tail) </label>';
				echo '</fieldset>';
				break;
		}
	echo '</div>';
}

ingMeasurement();
$i++;

?>