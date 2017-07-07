<?php
require_once('../../../core/database/mysqli_connect.php');
$staticInfo = $_POST['sushi'];
$variableInfo = $_POST['item'];
$query = "INSERT INTO meals(meal_name,container_size) VALUES (?,?)";
$stmt = mysqli_prepare($dbc,$query);
mysqli_stmt_bind_param($stmt,"ssii",$staticInfo['name'],$staticInfo['container']);
mysqli_stmt_execute($stmt);
$affected_rows = mysqli_stmt_affected_rows($stmt);
if ($affected_rows){
	echo 'Item Created';
}else{
	echo 'Error Occured';
	echo mysqli_error($dbc);
}
mysqli_stmt_close($stmt);

$variableInfo['meal_number']= mysqli_insert_id($dbc);  //Gets the meal_number (primary key) generated in the above query

$variableInfoCounter = count($variableInfo);
$query = "INSERT INTO meal_items(item_number,meal_number) VALUES (?,?)";
$stmt = mysqli_prepare($dbc,$query);
for($ii=1;$ii<=($variableInfoCounter/3);$ii++){
	$variableInfo['item'.$ii.''] = trim($_POST['item']['item'.$ii.'']);
	$variableInfo['amt'.$ii.''] = trim($_POST['item']['amt'.$ii.'']);
	mysqli_stmt_bind_param($stmt,"iii",$variableInfo['item'.$ii.''],$variableInfo['meal_number']);
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
header("Refresh: 1.2; URL=http://localhost/kms/meal_builder.php");
//echo '';
?>