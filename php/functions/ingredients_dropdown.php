<?php 

$n=1; //counter for each ingredient in dropdown menu
$i=$_POST["increm"];
require_once('../../core/database/mysqli_connect.php');  
function ingdropdown(){
	global $dbc;
    global $i;
	
	echo '<div id = "rowHeader'.$i.'" class = "w3-container w3-card-4 w3-padding w3-blue w3-margin">'.$i.'</div>';
	
	echo '<div id = "ingredientsRow'.$i.'" class = "w3-card-4 w3-padding w3-margin">';
        echo '<p>';
	    echo '<select class="w3-select" name = "ingredients[stock_item_number_'.$i.']" id = "ing'.$i.'" required onchange="addMeasurement(this.value,this)">';
	        echo '<option value="" default="" selected="" disabled="true">Pick an Ingredient</option>';
            $sql = mysqli_query($dbc, "SELECT stock_item_number, description, notes, measurement FROM stock ORDER BY description");
            while($row = $sql -> fetch_assoc()){
	            $id = $row['stock_item_number'];
	            $name = $row['description'];
	            $additional = $row['notes'];
	            echo '<option value ="'.$id.'">'.$name.' '.(($additional==true)?"- ".$additional:"").'</option>';
            }
        echo '</select>';
	    echo 'Ingredient';
	    echo '</p>';
	echo '</div>';
	  
}

ingdropdown();
$i++;

?>