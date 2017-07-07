<?php
	require_once('core/database/mysqli_connect.php');
	$staticInfo = $_POST['item_list'];
	$variableInfo = $_POST['ingredients'];
	//$staticInfo["yield"] = convert($staticInfo["yield"],$staticInfo["yieldMeas"]);
	//echo $staticInfo['item_type'];
	
	
	
	/*if ($staticInfo["yieldMeas"] == "g"|| $staticInfo["yieldMeas"] == "oz"||$staticInfo["yieldMeas"] == "lbm"){
		$staticInfo["yieldMeas"] = "g";
	}else if ($staticInfo["yieldMeas"] == "unit"){
	}
	else{
		$staticInfo["yieldMeas"] = "ml";
 	}*/
	
	
	
	$query = "INSERT INTO item_list(item_name,item_type,method,kitchen,created_by) VALUES (?,?,?,?,?)"; //yield removed
	$stmt = mysqli_prepare($dbc,$query);
	mysqli_stmt_bind_param($stmt,"sssss",$staticInfo['item_name']/*,$staticInfo['prep_time']*/,$staticInfo['item_type'],$staticInfo['method'],$staticInfo['kitchen']/*,$staticInfo['yield'],$staticInfo['yieldMeas']*/,$staticInfo['kitchen']);
	mysqli_stmt_execute($stmt);
	$affected_rows = mysqli_stmt_affected_rows($stmt);
	if ($affected_rows){
		//echo 'Item Created';
	}else{
		echo 'Error Occured';
		echo mysqli_error($dbc);
	}
	mysqli_stmt_close($stmt);
	
	$variableInfoCounter = count($variableInfo);
	$variableInfo['item_number']= mysqli_insert_id($dbc);  //Gets the item_number generated in the above query
	$query = "INSERT INTO ingredients(stock_item_number,amount,item_number) VALUES (?,?,?)";
	$stmt = mysqli_prepare($dbc,$query);
	for($ii=1;$ii<=($variableInfoCounter/3);$ii++){
		$variableInfo['stock_item_number'.$ii.''] = trim($_POST['ingredients']['stock_item_number_'.$ii.'']);
		$variableInfo['amount_'.$ii.''] = trim($_POST['ingredients']['amount_'.$ii.'']);
		$remainder = $variableInfo['amount_'.$ii.''] % $staticInfo['num_serv'];
		$variableInfo['amount_'.$ii.''] /= $staticInfo['num_serv']; //Calculates the amount for one serving to store into db
		$variableInfo['amount_'.$ii.''] = convert($variableInfo['amount_'.$ii.''],$variableInfo['ingMeas'.$ii.'']);
		//if ($remainder >= 5){$variableInfo['amount_'.$ii.'']++;};
		
		mysqli_stmt_bind_param($stmt,"ssi",$variableInfo['stock_item_number'.$ii.''],$variableInfo['amount_'.$ii.''],$variableInfo['item_number']);
		mysqli_stmt_execute($stmt);
	}
	$affected_rows = mysqli_stmt_affected_rows($stmt);
	if ($affected_rows){
		echo '<div class = "sucessMessage">Item created successfully!</div>';
	}else{
		echo 'Error Occured';
		echo mysqli_error($dbc);
	}
	mysqli_stmt_close($stmt);


	mysqli_close($dbc);
	header("Refresh: 1.2; URL=http://localhost/kms/item_creator.php");
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