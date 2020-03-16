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
	<title>RHub|Player</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
	<script>
		var included_cats = '<? if (isset($_POST["included_cats"])){echo html_entity_decode($_POST["included_cats"]);} else {echo null;} ?>';
	</script>
	<script src="./front/js/viewer.js"></script>
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
	<link rel="stylesheet" href="/front/css/styles.css">
	<script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
</head>
<body style="margin:0px; height: calc(100vh - 20px); width: 100vw; padding: 0px;">
	<button class="btn btn-default d-fixed btn-xs re-btn" id="re-btn"><i class="fas fa-dice fa-3x"></i></button>
	<form action="./viewer.php" class="hidden" id="launch-form" method="post">
	<input type="hidden" id="launch-input" target="_self">
	</form>
	<div class="player">
		<?
		include('./lib/shd.php');
		$options = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept-language: ru\r\n" .
		                "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17\r\n" // i.e. An iPad 
		  )
		);

		$context = stream_context_create($options);
		$html = file_get_html('https://play.google.com/store/apps', false, $context);
		foreach($html->find('a') as $element) {
		    echo "<pre>";
		    print_r( $element->href);
		    echo "</pre>";
		}
		//echo html_entity_decode($embed);
		 ?>
	</div>
	<script type="text/javascript">setUserAgent(document.querySelector('iframe').contentWindow, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15');</script>
</body>
</html>