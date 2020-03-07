$('#step_1').hide();
$('#step_2_c').hide();
$('#step_2_g').hide();
$('#step_2_l').hide();

var cats = new Map([['anal', false]]);  


function not_18(){
	window.location.replace("http://google.com/");
}

function next_step(step, step_prev){
	if(step == "allB")
		$('#lessB').hide("slow");
	if(step == "other")
		$('#lessB').show("slow");
	if(step == "allB1")
		$('#lessB1').hide("slow");
	if(step == "other1")
		$('#lessB1').show("slow");
	$('#'+step).show("slow");
	$('#'+step_prev).hide();
}

function cat_clicked(cat){
	if(!cats[cat]){
		cats[cat] = true;
		$('#'+cat).css('background-color', 'red');
	}else{
		cats[cat] = false;
		$('#'+cat).css('background-color', '');
	}
}

function viewer(cat){
	if(cat == "all")
	$.redirect('/viewer.php', {});
}

function viewer(){
	var query = [];
	var str_query;
	var i = 0;
	for(var entry in cats) {
		if(cats[entry])
			query[i] = entry;
		i++;
	}
	str_query = query.join();

	$.redirect('/viewer.php', {'included_cats': str_query});
}
