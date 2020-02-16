<?
include './api/apilib.php';
include './api/actions/random.php';
parse_str($_SERVER['QUERY_STRING'], $PARAMS);
$Random = new Random($PARAMS);

$result = $Random->Response()->getData();
if ($result["status"] == "success"){
	$embed = $result["data"];
}
if ($result["status"] == "error"){
	$embed = $result["description"];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>rhub.dev - view</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/front/css/styles.css">
	<script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="player">
		<!--<a href="/" ><div class="back-button"><i class="fas fa-arrow-left"></i></div></a>
		<div class="views"><i class="fas fa-eye"></i>34K</div>
		<div class="muted-button"><i class="fas fa-volume-mute"></i> <i class="fas fa-cog"></i> <i class="fas fa-volume-up"></i></div>
		<div class="timeline">
			<span class="play-button"><i class="fas fa-play"></i>\<i class="fas fa-pause"></i></span> .________________________________________________________________________
		</div>-->
		<?
		echo html_entity_decode($embed);
		 //print $embed; 
		 
		 
		 ?>
	</div>
</body>
</html>