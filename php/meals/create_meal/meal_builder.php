<div class = "module">
	<div class ="w3-container w3-blue w3-padding"><h1>Build-a-Meal</h1></div>
	<form class = "w3-card-8 w3-container w3-dark-grey w3-padding" action = "/kms/php/meals/create_meal/meal_added.php" method="post">
		<p>
		<input class="w3-input" type="text" name="meal[name]" id = "meal_name" size="30" value="" required>
		<label for = "meal_name">Meal Name</label>
		</p>
		<p>
		<select class="w3-input" name="meal[type]" id = "meal_type" value="" required>
			<option value = "" selected disabled>CHOOSE MEAL TYPE</option>
			<option value = "$45">$45</option>
			<option value = "Chicken">Chicken</option>
			<option value = "Meat">Meat</option>
			<option value = "Seafood">Seafood</option>
			<option value = "Vegetarian">Vegeterian</option>
			<option value = "Vegan">Vegan</option>
		</select>
		<label for = "meal_type">Meal Type</label>
		</p>
		<fieldset class = "w3-padding">
			<legend>Items</legend>
			<div id = "parentDiv"></div>
			<button type = "button" class = "w3-btn w3-light-grey w3-hover-green" onclick = "addItem()">Add Item</button>
			<button type = "button" class = "w3-btn w3-grey w3-hover-red" id = "delbut" onclick = "delRow('itemRow')">Remove</button><!---->
		</fieldset>
		<div class = "w3-row">
			<div class = "w3-third">
				<fieldset>
					<legend>Container</legend>
					<input type = "radio" id = "containerSoup" name = "meal[container]" class = "w3-radio" value = "Soup" required>
					<label class="w3-validate"> Soup </label><br>
					<input type = "radio" id = "containerM" name = "meal[container]" class = "w3-radio" value = "Medium" required>
					<label class="w3-validate"> Medium </label><br>
					<input type = "radio" id = "containerL" name = "meal[container]" class = "w3-radio"  value = "Large" required>
					<label class="w3-validate"> Large </label>
				</fieldset>
			</div>
			<div class = "w3-third cups">
				<fieldset>
					<legend>Cup</legend>
					<input type = "radio" class = "w3-radio" id = "1ozCup" name = "meal[cup_size]" onchange = "showCupAmt()" value = "1oz">
					<label class = "w3-validate"> 1oz </label>
					<select class = "w3-select container-size" id = "numberOfCups1Oz" name = "meal[cup_amount]" value = "" hidden disabled>
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
					<input type = "radio" class = "w3-radio" id = "2ozCup" name = "meal[cup_size]" onchange = "showCupAmt()" value = "2oz">
					<label class = "w3-validate"> 2oz </label>
					<select class = "w3-select container-size" id = "numberOfCups2Oz" name = "meal[cup_amount]" value = "" hidden disabled>
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
					<br>
					<input type = "radio" class = "w3-radio" id = "4ozCup" name = "meal[cup_size]" onchange = "showCupAmt()" value = "4oz">
					<label class = "w3-validate"> 4oz </label>
					<select class = "w3-select container-size" id = "numberOfCups4Oz" value = "" name = "meal[cup_amount]" hidden disabled>
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
				</fieldset>
			</div>
		</div>
		<br><br><br>
		<input type="submit" class = "w3-btn w3-light-grey w3-hover-green" name="submit" value="Submit"/>
	</form>
</div>