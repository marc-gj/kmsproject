<?php
require_once('../../../core/database/mysqli_connect.php');
$staticInfo = $_POST['meal'];
$variableInfo = $_POST['item'];
$query = "INSERT INTO meals(meal_name,container_size,cup_size,cup_amt,type) VALUES (?,?,?,?,?)";
$stmt = mysqli_prepare($dbc,$query);
mysqli_stmt_bind_param($stmt,"ssiis",$staticInfo['name'],$staticInfo['container'],$staticInfo['cup_size'],$staticInfo['cup_amount'],$staticInfo['type']);
mysqli_stmt_execute($stmt);
$affected_rows = mysqli_stmt_affected_rows($stmt);
if ($affected_rows){
	echo '<div class = "sucessMessage">Item created successfully!</div>';
}else{
	echo 'Error Occured';
	echo mysqli_error($dbc);
}
mysqli_stmt_close($stmt);

$variableInfoCounter = count($variableInfo);
$variableInfo['meal_number']= mysqli_insert_id($dbc);  //Gets the meal_number (primary key) generated in the above query


echo $variableInfoCounter;
print_r ($variableInfo);

$query = "INSERT INTO meal_items(item_number,meal_number) VALUES (?,?)";
$stmt = mysqli_prepare($dbc,$query);
for($ii=1;$ii<=($variableInfoCounter);$ii++){
	$variableInfo['item'.$ii.''] = trim($_POST['item']['item'.$ii.'']);
	mysqli_stmt_bind_param($stmt,"ii",$variableInfo['item'.$ii.''],$variableInfo['meal_number']);
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
header("Refresh: 1.2; URL=http://localhost/kms/meal_builder.php");
//echo ''; 
?>