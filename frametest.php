<?
$link = $_GET['link'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />
    <link rel="stylesheet" href="./front/css/frame.css">
</head>
<body>
    <iframe id='main_frame' src="http://theproject.me/api/api.php?action=getiframe&embed_link=<? echo urlencode($link); ?>" frameborder="0"></iframe>
        <video id = "main_player" poster="<? echo $thumbnail; ?>" playsinline controls>
			<source id="main_player_source" src="" type="video/mp4" />
		</video>





        
        <script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
        <script src="./front/js/frame.js"></script>
</body>
</html>