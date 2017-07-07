<div class = "module">
	<div class ="w3-container w3-blue module-heading"><h1>Create a new Seasoning</h1></div>
	<form action = "seasoning_added.php" method="post" class = "w3-card-8 w3-container w3-dark-grey w3-padding">
		  <p>
		  <input type="text" name="seasoning[name]" id = "seasoning_name"  class="w3-input"  value="" required/>
		  <label for = "item_name">Name</label></p>
		  <p>
		  <input type="text" name="seasoning[note]" id = "seasoning_note"  class="w3-input"  value="" required/>
		  <label for = "item_name">Note</label></p>
		  
		  <h3>Enter ingredients below to <b style = "color:lime">yield 1 cup</b> of seasoning</h3>

		  <fieldset class = "w3-padding">
			  <legend>Ingredients</legend>
			  <div id = "parentDiv">
			  </div>
			  <button type = "button" id = "addbut"  class = "w3-btn w3-light-grey w3-hover-green" onclick = "addIngredient()">Add Ingredient</button>
			  <button type = "button" id = "delbut" class = "w3-btn w3-grey w3-hover-red" onclick = "delRow('ingredientsRow')">Remove</button><!---->
		  </fieldset>
		  
		  <fieldset>
			  <legend>Preparation Instructions</legend>
			  <textarea name = "seasoning[method]"></textarea>
		  </fieldset>
		  
		  <br><br><p><input type="submit" name="submit" class = "w3-btn w3-light-grey w3-hover-green" value="Submit"/></p>
	</form>
</div>