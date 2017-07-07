<div class = "module">
	<div class = "w3-container w3-blue w3-padding"><h2>Search for a Meal</h2></div>
	<div class = "w3-container w3-card-8 w3-dark-grey w3-padding">
		<div style = "display:inline-block" class = "w3-padding">
		<input class = "w3-check meal_filter" type = "checkbox" name = "meal_type" value = "$45" id = "$45"><label class = "w3-validate" for = "$45">$45</label></br>
			<input class = "w3-check meal_filter" type = "checkbox" name = "meal_type" value = "chicken" id = "chicken"><label class = "w3-validate" for = "chicken">Chicken</label></br>
			<input class = "w3-check meal_filter" type = "checkbox" name = "meal_type" value = "meat" id = "meat"><label class = "w3-validate" for = "meat">Meat</label></br>
		</div>
		<div style = "display:inline-block">
			<input class = "w3-check meal_filter" type = "checkbox" name = "meal_type" value = "seafood" id = "seafood"><label class = "w3-validate" for = "seafood">Seafood</label><br>		
			<input class = "w3-check meal_filter" type = "checkbox" name = "meal_type" value = "vegetarian" id = "vegetarian"><label class = "w3-validate" for = "vegetarian">Vegetarian</label></br>
			<input class = "w3-check meal_filter" type = "checkbox" name = "meal_type" value = "vegan" id = "vegan"><label class = "w3-validate" for = "vegan">Vegan</label>
		</div>
	</div>
</div>
	<div id="recipe"></div>	
	<div id="meal_list"></div>
</div>
<script>

$(document).ready(function(){
	var arrayTest = [];
	$(".meal_filter").change(function(){
		$('.meal_filter:checkbox:checked').each(function(){
			arrayTest.push($(this).val());
		});
		var data = {data:arrayTest};
		var url = 'php/functions/meal_preview.php';
		if ($('.meal_filter:checkbox:checked').val() != null){ 
		$.post(url, data, function(response){
			$("#meal_list").html(response);
			$("#meal_list").hide();
			$("#meal_list").fadeOut(75, function(){
			$("#meal_list").fadeIn();
			});
			arrayTest = [];

		});
		}else{
			$("#meal_list").hide("slow");
		}
	});
});

</script>