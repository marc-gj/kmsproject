<?php
require_once('../core/database/mysqli_connect.php');
var_dump($_POST['meal']);
echo '<br><br><br><br>';
$formArray = array($_POST['meal']);
var_dump($formArray);
echo '<br><br><br><br>';


print_r ($_POST);
/*if(isset($_POST['submit'])){
	$data_missing = array();
	if(empty($_POST['item_name'])){
		$data_missing[]="Name";
	} else {
		$item_name = trim($_POST['item_name']);
	}
}*/
?>