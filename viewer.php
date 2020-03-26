<?
error_reporting(0);
include './api/apilib.php';
include './api/actions/random.php';
$Random = new Random($_POST);
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
	<meta name="theme-color" content="#000">
	<meta name="mobile-web-app-capable" content="yes">
	<title>PHRandom|Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>
		var included_cats = '<? if (isset($_POST["included_cats"])){echo html_entity_decode($_POST["included_cats"]);} else {echo null;} ?>';
	</script>
	<script src="./front/js/viewer.js"></script>
	<link rel="stylesheet" href="/front/css/styles.css">
	<script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
</head>
<body style="margin:0px; height: calc(100vh - 20px); width: 100vw; padding: 0px;">
	<button class="btn btn-default d-fixed btn-lg re-btn" id="re-btn"><i class="fas fa-dice"></i></button>
	<form action="./viewer.php" class="hidden" id="launch-form" method="post">
	<input type="hidden" id="launch-input" target="_self">
	</form>
	<div class="player">
		<?
		echo html_entity_decode($embed);
		 ?>
	</div>
	<script type="text/javascript">setUserAgent(document.querySelector('iframe').contentWindow, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15');</script>
</body>
</html>