<?
$list = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data'));
$all = $list->all;
$featured = $list->popularClassic;
$HELP_MODAL_DESCRIPTION = locale('help-modal-description','Удерживайте пресет чтобы увидеть подсказку','service');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script> const SITE_LANG = '<? echo html_entity_decode($SITE_LANG); ?>';
            const HELP_MODAL_DESCRIPTION = '<? echo html_entity_decode($HELP_MODAL_DESCRIPTION); ?>';
    </script>

    <script src="front/js/script.js"></script>
    <link rel="stylesheet" href="front/fonts/SF Display/SFUIDisplay.css">
    <link rel="stylesheet" href="front/css/front.css">
    <title>Document</title>
</head>
<body>
    
    <div id="presets" class="modal" style="display:none!important;">
        <p>Выберите один из пресетов</p>
        <div class="presets">
        <? 
            $presets = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/presets.json'));
            foreach ($presets as $preset){
                if (isset($preset->description->{$SITE_LANG})){
                    $LANG = $SITE_LANG;
                }else{
                    $LANG = $DEFAULT_LANG;
                }
                echo "<div class=\"preset\" aria-describedby=\"tooltip\" data-description='".$preset->description->{$LANG}."' data-type='".$preset->type."' data-cats='".implode(',',$preset->cats)."'><span>".$preset->name_locale->{$LANG}."</span></div>";
            }
        ?>
        <div class="preset">Preset 1</div>
        <div class="preset">Preset 2</div>
        <div class="preset">Preset 3</div>
        <div id="tooltip" role="tooltip">
            <span id="tooltip_text">My tooltip</span>
            <div id="arrow" data-popper-arrow></div>
        </div>
        </div>
    </div>





    <div id="header"> 
        <div class="navbar-brand"><? echo locale('brand','PHRand','service');?></div>
        <div class="control-group">
            <a class="control" href='#presets' rel="modal:open" ><? echo locale('presets','Пресеты','service'); ?></a>
            <a class="control" id="help">Помощь</a>
        </div>
    </div>
    <div id="content"> 
        <div class="content-header">
            <h1><? echo locale('choose-cats','Выберите категории','service'); ?></h1>
        </div>
        <div class="button" data-locale-all="<? echo locale('show_all_cats','Показать все категории','service');?>" data-locale-featured="<? echo locale('show_featured_cats','Показать избранные категории','service');?>" id="categories_toggle"><? echo locale('show_all_cats','Показать все категории','service');?></div>
        <div class="cat-list" id="featured_list">
            <?
                foreach ($featured as $entry) {
                echo '<div class="cat" data-category="'.$entry.'">'.locale($entry,'Категория','categories').'</div>';      
                }
                unset($entry);
            ?>
        </div>
        <div class="cat-list" id="all_list" style="display: none;">
            <?
                foreach ($all as $entry) {
                echo '<div class="cat" data-category="'.$entry.'">'.locale($entry,'Категория','categories').'</div>';      
                }
            ?>
        </div>
    </div>
    <div id="launch-btn" style="display:none;">O</div>
    <div id="preset-launch-btn" style="display:none;" >O</div>
    <form id="launch-form" action="viewer.php" method="post" target="_blank" class="hidden">
        <input id="launch-input" type="hidden">
    </form>
</body>
</html>