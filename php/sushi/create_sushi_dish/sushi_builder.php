<div class = "module">
	<div class ="w3-container w3-blue w3-padding"><h1>Build-a-Roll</h1></div>
	<form class = "w3-card-8 w3-container w3-dark-grey w3-padding" action = "/kms/php/sushi/create_sushi_dish/sushi_added.php" method="post">
		<p>
		<input input class="w3-input" type="text" name="sushi[name]" id = "sushi_name" size="30" value="" required>
		<label for = "meal_name">Roll Name</label>
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
					<input type = "radio" id = "containerM" name = "sushi[container]" class = "w3-radio" value = "m" required>
					<label class="w3-validate" for = "containerM"> Medium </label><br>
					<input type = "radio" id = "containerL" name = "sushi[container]" class = "w3-radio"  value = "l" required>
					<label class="w3-validate" for = "containerL"> Large </label>
				</fieldset>
			</div>
			<div class = "w3-third">
				<fieldset>
					<legend>Nori</legend>
					<input type = "radio" id = "noriWhole" name = "sushi[nori]" class = "w3-radio" value = "whole" required>
					<label class="w3-validate" for = "noriWhole"> Whole Sheet </label><br>
					<input type = "radio" id = "noriHalf" name = "sushi[nori]" class = "w3-radio"  value = "half" required>
					<label class="w3-validate" for = "noriHalf"> Half Sheet</label>
				</fieldset>
			</div>
		</div>
		<br><br><br>
		<input type="submit" class = "w3-btn w3-light-grey w3-hover-green" name="submit" value="Submit"/>
	</form>
</div>