<?php 


$i=$_POST["increm"];
require_once('../../core/database/mysqli_connect.php');  
function item_dropdown(){
	global $dbc;
	global $i;

	echo '<div id = "rowHeader'.$i.'" class = "w3-container w3-card-4 w3-padding w3-blue w3-margin">'.$i.'</div>';

	echo '<div id = "itemRow'.$i.'" class = "w3-card-4 w3-padding w3-margin-left w3-margin-right w3-margin-bottom">';
		echo '<p>';
		echo '<select name = "item[item'.$i.']" id = "item'.$i.'" class="w3-select">';
			echo '<option value="" default="" selected="" disabled="true">Pick an item</option>';
			$sql = mysqli_query($dbc, "SELECT item_number, item_name FROM item_list ORDER BY item_name ASC");
			while($row = $sql -> fetch_assoc()){
				$id = $row['item_number'];
				$name = $row['item_name'];
				echo '<option value ="'.$id.'">'.$name.'</option>';
			}
		echo '</select>';
		echo '<label for ="item[item'.$i.']">Item</label>';
		echo '</p>';
		echo '<p>';
		echo '</p>';
}

item_dropdown();
$i++;
//type name id class 
?>