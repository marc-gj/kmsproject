var incr = 1;
var ajaxurl = '/kms/php/functions/ingredients_dropdown.php';
var _ajaxurl = '/kms/php/functions/item_dropdown.php';
var __ajaxurl = '/kms/php/functions/ingredients_measurement.php';

function addIngredient(){    
    var data =  {increm : incr};
	$.post(ajaxurl, data, function (response) {
        $("#parentDiv").append(response);
		incr++;
    });
};

function addItem(){    
    var data =  {increm : incr};
	$.post(_ajaxurl, data, function (response) {
        $("#parentDiv").append(response);
		incr++;
    });
};

function showCupAmt(){
	if ($("#1ozCup").prop("checked")==true){
	    $("#numberOfCups1Oz").removeAttr("hidden");	
		$("#numberOfCups1Oz").attr("disabled", false);
	}
	else{
		$("#numberOfCups1Oz").attr("hidden","hidden");
		$("#numberOfCups1Oz").attr("disabled", true);
	};
	
	if ($("#2ozCup").prop("checked")==true){
	    $("#numberOfCups2Oz").removeAttr("hidden");	
		$("#numberOfCups2Oz").attr("disabled", false);
	}
	else{
		$("#numberOfCups2Oz").attr("hidden","hidden");
		$("#numberOfCups2Oz").attr("disabled", true);
	};
	
	if ($("#4ozCup").prop("checked")==true){
	    $("#numberOfCups4Oz").removeAttr("hidden");	
		$("#numberOfCups4Oz").attr("disabled", false);
	}
	else{
		$("#numberOfCups4Oz").attr("hidden","hidden");
		$("#numberOfCups4Oz").attr("disabled", true);
	};
	
};

function delRow(itemgred){
	if (incr > 1){
		incr--;
	    $("#"+itemgred+incr).remove();
		$("#rowHeader"+incr).remove();
	}
};

function addMeasurement(dat,n){ 
    incr--;    //Implement functionality to restrict the measurement options available to the user
	var data = {daat:dat,increm:incr};
    $.post(__ajaxurl, data, function (response){
		$("#Placeholder"+incr).remove();
	    $(n).parent().append(response);	
		incr++;
       // alert (response);
});
};

function clickItem(id){ //loads the recipe when an item is clicked
	var data = {clicked:id};
	var dummyurl = '/kms/php/functions/recipe.php';
	$.post(dummyurl, data, function(response){
	async: true
	$("#item_recipe").fadeOut(75, function(){
		var div = $(response).hide();
		$("#item_recipe").replaceWith(div);
		$("#item_recipe").fadeIn();
	});
	});
};

function clickDiv(id){ //loads the recipe when an item is clicked
	var data = {clicked:id};
	if ($(".module-small").data("meal")==="meal"){
		var dummyurl = '/kms/php/meals/edit_view_meal/recipe.php';
	}else{
		var dummyurl = '/kms/php/functions/recipe.php';
	}
	$.post(dummyurl, data, function(response){
		$("#recipe").fadeOut(75, function(){
			var div = $(response).hide();
			$("#recipe").replaceWith(div);
			$("#recipe").fadeIn();
		});
	});
};

function servSize(){
	var $multiplier = $("#serv").val();
	$(".tester").each(function(){
		var $num = $(this).attr("value")*$multiplier;
		$num = parseFloat($num).toFixed(2);
		$(this).text($num);
	});
};


$(document).on("click","#close",function(){
		$("#recipe").hide("fast");
});

function loadList(){
	$("#all").prop("checked",true);
};


/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
	if (screen.width > 768){
		document.getElementById("mySidenav").style.width = "250px";
		document.getElementById("pageContent").style.marginLeft = "250px";
	}else{
		document.getElementById("mySidenav").style.width = "200px";
		document.getElementById("pageContent").style.marginLeft = "200px";
	};
	document.getElementById("menu").setAttribute('onclick','closeNav()');
};

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("pageContent").style.marginLeft = "0";
	document.getElementById("menu").setAttribute('onclick','openNav()');
};

//$(document).on("click","#item_type",function(){
//	$()
//}

$(document).on("click",".showHide", function(){
	$(this).next().toggle("fast");
});


function navToggle(){
	var checkScreenWidth;
	if (!checkScreenWidth && screen.width < 800){
		document.getElementById("menu").setAttribute('onclick','openNav()');
	}else{
		document.getElementById("menu").setAttribute('onclick','closeNav()');
	};
	checkScreenWidth = true;
};



