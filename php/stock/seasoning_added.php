<?php
	require_once('core/database/mysqli_connect.php');
	$staticInfo = $_POST['seasoning'];
	$variableInfo = $_POST['ingredients'];
	$staticInfo['purchased_by'] = 'in-house';
	$staticInfo['amount_per_unit'] = 1000;
	$staticInfo['unit_per_case'] = 1;
	$staticInfo['measurement'] =  'ml';
	//echo $staticInfo['item_type'];
	$query = "INSERT INTO stock(description, notes, purchased_by, unit_per_case, amount_per_unit, measurement, method) VALUES (?,?,?,?,?,?,?)";
	$stmt = mysqli_prepare($dbc,$query);
	mysqli_stmt_bind_param($stmt,"sssidss",$staticInfo['name'],$staticInfo['note'],$staticInfo['purchased_by'],$staticInfo['unit_per_case'],$staticInfo['amount_per_unit'],$staticInfo['measurement'],$staticInfo['method']);
	mysqli_stmt_execute($stmt);
	$affected_rows = mysqli_stmt_affected_rows($stmt);
	if ($affected_rows){
		//echo 'Item Created';
	}else{
		echo 'Error Occured';
		echo mysqli_error($dbc);
	}
	mysqli_stmt_close($stmt);

	$variableInfo['stock_item_number']= mysqli_insert_id($dbc);  //Gets the item_number generated in the above query

	$variableInfoCounter = count($variableInfo);
	$query = "INSERT INTO seasoning_ingredients(stock_item_number,amount,stock_input) VALUES (?,?,?)";
	$stmt = mysqli_prepare($dbc,$query);
	for($ii=1;$ii<=($variableInfoCounter/3);$ii++){
		$variableInfo['stock_input'.$ii.''] = trim($_POST['ingredients']['stock_item_number_'.$ii.'']);
		$variableInfo['amount_'.$ii.''] = trim($_POST['ingredients']['amount_'.$ii.'']);
		$variableInfo['amount_'.$ii.''] = convert($variableInfo['amount_'.$ii.''],$variableInfo['ingMeas'.$ii.'']);
		//if ($remainder >= 5){$variableInfo['amount_'.$ii.'']++;};
		
		mysqli_stmt_bind_param($stmt,"idi",$variableInfo['stock_item_number'],$variableInfo['amount_'.$ii.''],$variableInfo['stock_input'.$ii.'']);
		mysqli_stmt_execute($stmt);
	}
	$affected_rows = mysqli_stmt_affected_rows($stmt);
	if ($affected_rows){
		echo 'Item created successfully!';
	}else{
		echo 'Error Occured';
		echo mysqli_error($dbc);
	}
	mysqli_stmt_close($stmt);


	mysqli_close($dbc);
	header("Refresh: 1.2; URL=http://localhost/kms/seasoning_creator.php");
	//echo '';
	
	function convert($num,$uom){
		switch ($uom){
			case "g":
				break; //do nothing if already gram
			case "oz":
				$num *= 28.3495; //convert to grams
				break;
			case "lbm":
				$num *= 453.592; //convert to grams
				break;
			case "tsp":
				$num *= 4.92892; //convert to millilitres
				break;
			case "tbsp":
				$num *= 14.7868; //convert to millilitres
				break;
			case "foz":
				$num *= 29.5735; //convert to millilitres
				break;
			case "cup":
				$num *= 240; //convert to millilitres
				break;
			case "pint":
				$num *= 473.176; //convert to millilitres
				break;
			case "quart":
				$num *= 946.353; //convert to millilitres
				break;
			case "gal":
				$num *= 3785.41; //convert to millilitres
				break;
			case "ml":
				break; //do nothing if already ml
		}
		return $num;
	}
?>