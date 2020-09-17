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
$show_advertisement = false;
if (isset($_GET["referrer"])){
	switch ($_GET["referrer"]) {
		case 'self':
			$show_advertisement = false;
			break;
		
		default:
			$show_advertisement = true;
			break;
	}
}else{
	$show_advertisement = true;
}
$ad_obf = array(
"ad-block"=>""



);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="theme-color" content="#000">
	<meta name="mobile-web-app-capable" content="yes">
	<title>PHRandom|Player</title>
	<? include 'meter.php';
		include 'SEO_v.php';
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/screenfull.js/5.0.0/screenfull.min.js"></script>-->
	<script>
		var included_cats = '<? if (isset($_POST["included_cats"])){echo html_entity_decode($_POST["included_cats"]);} else {echo null;} ?>';
	</script>
	<script src="./front/js/viewer.js"></script>
	<script src="./front/js/ajax.js"></script>
	<link rel="stylesheet" href="front/fonts/SF Display/SFUIDisplay.css">
	<link rel="stylesheet" href="/front/css/styles.css">
	<script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
</head>	
<body style="margin:0px; height: calc(100vh - 20px); width: 100vw; padding: 0px;" allowfullscreen>
	<? if(!$show_advertisement){ ?>
	<button class="btn btn-default d-fixed btn-lg re-btn" id="re-btn"><i class="fas fa-dice"></i></button>
	<form action="./viewer.php" class="hidden" id="launch-form" method="post">
	<input type="hidden" id="launch-input" target="_self">
	</form>
	<div class="player">
		<?
		echo html_entity_decode($embed);
		 ?>
	</div>
	<? } else { ?>
	<div class="ad-section">
		<div class="ad-block">
			<iframe src="//a.exosrv.com/iframe.php?idzone=3807501&size=300x250" width="300" height="250" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
		</div>
		<div class="ad-skip-block">
			<div class="ad-skip-button-group">
				<a class="ad-skip-button" href="#">
					Пропустить рекламу
				</a>
			</div>
			<div class="ad-skip-text">
				Перенаправление через:&nbsp;<span id="countdown">5</span>
			</div>
		</div>
	</div>





	<? } ?>
	<script type="application/javascript" data-idzone="3804337" src="https://a.exosrv.com/nativeads.js" ></script>
	<!--<script type="text/javascript">
setUserAgent(window, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15');
setUserAgent(document.querySelector('iframe').contentWindow, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15');</script>-->
</body>
</html>