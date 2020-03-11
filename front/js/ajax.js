$('#step_1').hide();
$('#step_2_c').hide();
$('#step_2_g').hide();
$('#step_2_l').hide();

var cats = new Map([['anal', false]]);  
var allToggle = false;
var classic = [
		"180-1",
		"2d",
		"360-1",
		"3d",
		"60fps-1",
		"amateur",
		"anal",
		"arab",
		"asian",
		"babe",
		"babysitter",
		"bbw",
		"behind-the-scenes",
		"big-ass",
		"big-dick",
		"big-tits",
		"bisexual-male",
		"blonde",
		"blowjob",
		"bondage",
		"brazilian",
		"british",
		"brunette",
		"bukkake",
		"cartoon",
		"casting",
		"celebrity",
		"closed-captions",
		"college",
		"compilation",
		"cosplay",
		"creampie",
		"cuckold",
		"cumshot",
		"czech",
		"described-video",
		"double-penetration",
		"ebony",
		"euro",
		"exclusive",
		"feet",
		"female-orgasm",
		"fetish",
		"ffm",
		"fingering",
		"fisting",
		"fmm",
		"french",
		"funny",
		"gangbang",
		"german",
		"handjob",
		"hardcore",
		"hd-porn",
		"hentai",
		"indian",
		"interactive",
		"interracial",
		"italian",
		"japanese",
		"korean",
		"latina",
		"lesbian",
		"massage",
		"masturbation",
		"mature",
		"milf",
		"muscular-men",
		"music",
		"old-young",
		"orgy",
		"parody",
		"party",
		"pissing",
		"popular-with-women",
		"pornstar",
		"pov",
		"pov-1",
		"public",
		"pussy-licking",
		"reality",
		"red-head",
		"role-play",
		"romantic",
		"rough-sex",
		"russian",
		"school",
		"scissoring",
		"sfw",
		"small-tits",
		"smoking",
		"solo-female",
		"solo-male",
		"squirt",
		"step-fantasy",
		"strap-on",
		"striptease",
		"tattooed-women",
		"teen",
		"threesome",
		"toys",
		"trans-male",
		"trans-with-girl",
		"trans-with-guy",
		"transgender",
		"uncensored",
		"uncensored-1",
		"verified-amateurs",
		"verified-couples",
		"verified-models",
		"vintage",
		"vr",
		"voyeur",
		"webcam"
	];
var gay = [
		"amateur-gay",
		"asian-gay",
		"bareback-gay",
		"bear-gay",
		"black-gay",
		"big-dick-gay",
		"blowjob-gay",
		"cartoon-gay",
		"casting-gay",
		"chubby-gay",
		"closed-captions-gay",
		"college-gay",
		"compilation-gay",
		"creampie-gay",
		"cumshot-gay",
		"daddy-gay",
		"euro-gay",
		"feet-gay",
		"fetish-gay",
		"group-gay",
		"handjob-gay",
		"hd-porn-gay",
		"hunks-gay",
		"interracial-gay",
		"japanese-gay",
		"jock-gay",
		"latino-gay",
		"massage-gay",
		"mature-gay",
		"military-gay",
		"muscle-gay",
		"pov-gay",
		"public-gay",
		"reality-gay",
		"rough-sex-gay",
		"solo-male-gay",
		"straight-guys-gay",
		"tattooed-men-gay",
		"twink-gay",
		"uncut-gay",
		"verified-amateurs-gay",
		"vintage-gay",
		"vr-gay",
		"webcam-gay"
	];


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

function cat_all(type){
	if(!allToggle){
		allToggle = true;
		$('#all_'+type).css('background-color', 'rgb(247,145,0)');
	}else{
		allToggle = false;
		$('#all_'+type).css('background-color', '');
	}
	if(type == "classic")
		classic.forEach(function(item, i, arr){
			cat_clicked(item);
		});
	else if(type == "gay")
		gay.forEach(function(item, i, arr){
			cat_clicked(item);
		});
}

function cat_clicked(cat){
	if(!cats[cat]){
		cats[cat] = true;
		$('#'+cat).css('background-color', 'rgb(247,145,0)');
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
