
<div class = "module">
	<div class ="w3-container w3-blue w3-padding"><h1>Create a new Sushi item</h1></div>
	<form action = "item_added.php" method="post" class = "w3-card-8 w3-container w3-dark-grey w3-padding">
		<p>
		<input type="text" name="item_list[item_name]" id = "item_name"  class="w3-input"  value="" required/>
		<label for = "item_name">Sushi Item Name</label></p>

		<select name = "item_list[kitchen]" hidden>
			<option value = "sushi"></option>
		</select>
		
		<p>
		<select name = "item_list[item_type]" class = "w3-select" id="item_type" required>
			<option value = "" default = "" selected = "" disabled = "true">SELECT TYPE OF ITEM</option>
			<option value = "Fish">Fish</option>
			<option value = "Shellfish">Shellfish</option>
			<option value = "Veg">Veg</option>
			<option value = "Meat">Meat</option>
			<option value = "Dairy">Dairy</option>
			<option value = "Rice">Rice</option>
			<option value = "Sauce">Sauce</option>
			<option value = "Wrap">Wrap (Example: Nori, Rice Paper)</option>
		</select>
		<label for = "item_type">Item Type</label></p>

		<!--<p>
		<input type="number" name="item_list[prep_time]" id = "prep_time" class="w3-input"  value="" required/>
		<label for = "prep_time">Prep Time (minutes)</label></p>-->

		<p>
		<input type="number" name="item_list[yield]" id = "yield" class="w3-input"  value="" required/>
		<label for = "yield">Yield</label></p>
		<div id = "measurement"></div>

		<p>
		<input type="number" name="item_list[num_serv]" id = "num_serv" class="w3-input"  value="" required/>
		<label for = "num_serv">Servings Produced</label></p>

		<div id = "yield_measurment_unit"></div>

		<fieldset class = "w3-padding">
			<legend>Ingredients</legend>
			<div id = "parentDiv">
			</div>
			<button type = "button" id = "addbut"  class = "w3-btn w3-light-grey w3-hover-green" onclick = "addIngredient()">Add Ingredient</button>
			<button type = "button" id = "delbut" class = "w3-btn w3-grey w3-hover-red" onclick = "delRow('ingredientsRow')">Remove</button><!---->
		</fieldset>

		<fieldset>
			<legend>Preparation Instructions</legend>
			<textarea name = "item_list[method]" placeholder = "Bake at 350 degrees celcius for 20 minutes. Rock back and sip a beer until complete"></textarea>
		</fieldset>

		<br><br><p><input type="submit" name="submit" class = "w3-btn w3-light-grey w3-hover-green" value="Submit"/></p>
	</form>
</div>

<script type = "text/measurement_markup" id = "markUpVolume">
<fieldset>
	<legend>Volume</legend>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "ml'.$i.'" value = "ml" required>
		<label class="w3-validate"> ml </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "tsp'.$i.'" value = "tsp" required>
		<label class="w3-validate"> tsp </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "tbsp'.$i.'" value = "tbsp" required>
		<label class="w3-validate"> tbsp </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "foz'.$i.'" value = "foz" required>
		<label class="w3-validate"> foz </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "foz'.$i.'" value = "cup" required>
		<label class="w3-validate"> cup </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "foz'.$i.'" value = "quart" required>
		<label class="w3-validate"> quart </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "foz'.$i.'" value = "pint" required>
		<label class="w3-validate"> pint </label>
	<input class="w3-radio" type = "radio" name = "item_list[yieldMeas]" id = "foz'.$i.'" value = "gal" required>
		<label class="w3-validate"> gal </label>
</fieldset>
</script>

<script type = "text/measurement_markup" id = "markUpMass">
<fieldset>	
	<legend>Mass</legend>
	<input type = "radio" name = "item_list[yieldMeas]" id = "g'.$i.'" class="w3-radio" value = "g" required>
		<label class="w3-validate"> g </label>
	<input type = "radio" name = "item_list[yieldMeas]" id = "oz'.$i.'" class="w3-radio" value = "oz" required>
		<label class="w3-validate"> oz </label>
</fieldset>
</script>

<script type = "text/measurement_markup" id = "markUpUnit">
<fieldset>
	<legend>Unit</legend>
	<input type = "radio" name = "item_list[yieldMeas]" id = "unit'.$i.'" class="w3-radio" value = "unit" required>
		<label class="w3-validate"> Unit (Ex. Lobster Tail) </label>
</fieldset>
</script>

<script>
	$("#item_type").change(function(){
		var itemType = $("#item_type").val();
		switch (itemType){
			case "Sauce":
				var markUpVolume = $("#markUpVolume").html();
				$("#measurement").html(markUpVolume);
				break;
			case "Wrap":
				var markUpUnit = $("#markUpUnit").html();
				$("#measurement").html(markUpUnit)
				break;
			default:
				var markUpMass = $("#markUpMass").html();
				$("#measurement").html(markUpMass);
		};
	});
</script>

