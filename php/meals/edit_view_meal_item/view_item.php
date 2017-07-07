<div class = "module">
	<div class = "w3-container w3-blue w3-padding"><h2>Search for Item</h2></div>
	<div class = "w3-container w3-card-8 w3-dark-grey w3-padding">
		<div style = "display:inline-block" class = "w3-padding">
			<input class = "w3-check item_filter" type = "checkbox" name = "item_type" value = "Main" id = "Main"><label class = "w3-validate" for = "Main">Main</label></br>
			<input class = "w3-check item_filter" type = "checkbox" name = "item_type" value = "Side" id = "Side"><label class = "w3-validate" for = "Side">Side</label></br>
			<input class = "w3-check item_filter" type = "checkbox" name = "item_type" value = "Sauce" id = "Sauce"><label class = "w3-validate" for = "Sauce">Sauce</label>
		</div>
	</div>
</div>
	<div id="recipe"></div>	
	<div id="item_list"></div>
</div>
<script>

$(document).ready(function(){
	var arrayTest = [];
	$(".item_filter").change(function(){
		$('.item_filter:checkbox:checked').each(function(){
			arrayTest.push($(this).val());
		});
		var data = {data:arrayTest};
		var url = 'php/functions/item_preview.php';
		if ($('.item_filter:checkbox:checked').val() != null){ 
		$.post(url, data, function(response){
			$("#item_list").html(response);
			$("#item_list").hide();
			$("#item_list").fadeOut(75, function(){
			$("#item_list").fadeIn();
			});
			arrayTest = [];

		});
		}else{
			$("#item_list").hide("slow");
		}
	});
});

</script>