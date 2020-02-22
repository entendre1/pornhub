<?


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="front/js/script.js"></script>
    <link rel="stylesheet" href="front/fonts/SF Display/SFUIDisplay.css">
    <link rel="stylesheet" href="front/css/front.css">
    <title>Document</title>
</head>
<body>
    <div id="header"> 
        <div class="navbar-brand">PornHub Randomizer</div>
        <div class="control-group">
            <div class="control">Control 1</div>
            <div class="control">Control 2</div>
        </div>
    </div>
    <div id="content"> 
        <div class="content-header">
            <h1>Choose your categories</h1>
        </div>
        <div class="cat-list">
            <div class="cat" data-category="hentai">Hentai</div>
            <div class="cat" data-category="anal">Anal</div>
            <div class="cat" data-category="creampie">Creampie</div>
            <div class="cat" data-category="cartoon">Cartoon</div>
            <div class="cat" data-category="gay">Gay</div>
        </div>
    </div>
    <div id="footer">
        <div id="cat-list">
            <span class="cat-list-element">Cat 1</span>
            <span class="cat-list-element">Cat 2</span>
            <span class="cat-list-element">Cat 3</span>
            <span class="cat-list-element">Cat 4</span>
            <span class="cat-list-element">Cat 5</span>
            <span class="cat-list-element">Cat 6</span>
        </div>
        <div id="find-btn">
            FIND!
        </div>

    </div>
    <div id="launch-btn" style="display:none;">L</div>
    <form id="launch-form" action="viewer.php" method="post" target="_blank" class="hidden">
        <input id="launch-input" type="hidden">
    </form>
</body>
</html>