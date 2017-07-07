<?php 
include 'core/database/mysqli_connect.php';
include 'core/functions/general.php';
	global $dbc;
	$i = 0;
    $j = 0;
	$query = "
	SELECT
		meals.meal_name,
		item_list.item_name
	FROM meals
	JOIN meal_items
		ON meals.meal_number = meal_items.meal_number
	JOIN item_list
		ON meal_items.item_number = item_list.item_number";
	$response = mysqli_query($dbc,$query);
    //Create 2 arrays with the meal names and item names. They will be mapped equally meal name to item name.
	while($row = mysqli_fetch_assoc($response)){ 
        $item['meal'][$i] = $row['meal_name'];
        $item['item_name'][$i] = $row['item_name'];
        $i++;
	}
    //Fix and error where the first call didn't return a space in the meal name
   $item['meal'][0] = $item['meal'][1];
   //Put a null field at the end of item_name to eliminate an undefined offset error
   $item['item_name'][count($item['item_name'])-1] = null;
    //Display Meals with their sides
    for ($i = 0; $i < count($item['meal'])-1; $i=$j){
        $j++;
        echo "<b>";
        echo "<h3>";
        echo $item['meal'][$i];
        echo "</h3></b><br>";
            while ($item['item_name'][$j] != null && $item['meal'][$i] === $item['meal'][$j]){
            echo $item['item_name'][$j-1];
            echo "<br>";
            $j++;
        }
        echo $item['item_name'][$j-1];
        echo "<br>";
}
?>

