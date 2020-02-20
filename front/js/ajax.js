$('#step_1').hide();
$('#step_2_c').hide();
$('#step_2_g').hide();
$('#step_2_l').hide();

var cats = new Map([['anal', false]]);  


function not_18(){
	window.location.replace("http://google.com/");
}

function next_step(step, step_prev){
	$('#'+step).show();
	$('#'+step_prev).hide();
}

function cat_clicked(cat){
	if(!cats[cat]){
		cats[cat] = true;
		$('#'+cat).css('border', 'solid 1px white');
	}else{
		cats[cat] = false;
		$('#'+cat).css('border', 'none');
	}
}

function viewer(cat){
	$.redirect('/viewer.php', {'included_cats': cat});
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

function createMap(){

}
