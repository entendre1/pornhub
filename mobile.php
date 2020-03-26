<?
$list = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data'));
$all = $list->all;
$featured = $list->popularClassic;
$HELP_MODAL_DESCRIPTION = locale('help-modal-description','Удерживайте пресет чтобы увидеть подсказку','service');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(61367311, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/61367311" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <meta name="theme-color" content="#1b1b1b">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no ">
    <link rel="icon" type="image/png" sizes="32x32" href="./front/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./front/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./front/img/favicon-16x16.png">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://kit.fontawesome.com/581d130f1d.js" crossorigin="anonymous"></script>
    <script> const SITE_LANG = '<? echo html_entity_decode($SITE_LANG); ?>';
            const HELP_MODAL_DESCRIPTION = '<? echo html_entity_decode($HELP_MODAL_DESCRIPTION); ?>';
    </script>

    <script src="front/js/script.js"></script>
    <link rel="stylesheet" href="front/fonts/SF Display/SFUIDisplay.css">
    <link rel="stylesheet" href="front/css/front.css">
    <title><? echo locale('brand','PHRandom','service'); ?></title>
</head>
<body class="stop-scrolling">
    <div id="age-overlay" class="chapter"> 
        <div class="chapter-header">
            <h1><? echo locale('18-question','Вам исполнилось 18 лет?','service'); ?></h1>
        </div>
        <div class="chapter-question">
                <div id="18-control" class="question-control success"><? echo locale('yes','Да','service'); ?></div>
                <div id="go-out" class="question-control error"><? echo locale('no','Нет','service'); ?></div>
        </div>
    </div>
    <div id="service-popularClassic" style="display:none;">
        <?
            foreach ($list->popularClassic as $entry) {
                echo '<div class="cat" data-category="'.$entry.'">'.locale($entry,$entry,'categories').'</div>';      
            }
        ?>
    </div>
    <div id="service-popularGay" style="display:none;">
        <?
            foreach ($list->popularGay as $entry) {
                echo '<div class="cat" data-category="'.$entry.'">'.locale($entry,$entry,'categories').'</div>';      
            }
        ?>
    </div>
    <div id="crossroad" class="chapter" style="display:none;">
        <div class="chapter-controls">
            <div id="crossroad-classic" class="chapter-control">
                <i class="fas fa-venus-mars fa-4x" aria-hidden="true"></i> 
                <span>Классика</span>
             </div>
            <div id="crossroad-gay" class="chapter-control">
                <i class="fas fa-mars-double fa-4x" aria-hidden="true"></i>
                <span>Гей</span>
            </div>
            <div id='crossroad-random' class="chapter-control">
                <i class="fas fa-dice fa-4x" aria-hidden="true"></i>
                <span>Случайно</span>
            </div>
        </div>
    </div>
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
        <div id="tooltip" role="tooltip">
            <span id="tooltip_text">My tooltip</span>
            <div id="arrow" data-popper-arrow></div>
        </div>
        </div>
    </div>





    <div id="header"> 
        <div id="back-to-crossroad"><i class="fas fa-arrow-left"></i></div>
        <div class="navbar-brand"><? //echo locale('brand','PHRand','service');?> <img  src="./front/img/logo.png" alt="<? echo locale('brand','PHRand','service');?>"></div>
        <div class="control-group">
            <a class="control" href='#presets' rel="modal:open" ><? echo locale('presets','Пресеты','service'); ?></a>
            <a class="control" id="help"><? echo locale('help','Помощь  ','service'); ?></a>
        </div>
        <div id="right"></div>
    </div>
    <div id="content"> 
        <div class="content-header">
            <h1><? echo locale('choose-cats','Выберите категории','service'); ?></h1>
        </div>
        <div class="button" data-locale-all="<? echo locale('show_all_cats','Показать все категории','service');?>" data-locale-featured="<? echo locale('show_featured_cats','Показать избранные категории','service');?>" id="categories_toggle"><? echo locale('show_all_cats','Показать все категории','service');?></div>
        <div class="cat-list" id="featured_list">
            <?
                foreach ($featured as $entry) {
                echo '<div class="cat" data-category="'.$entry.'">'.locale($entry,$entry,'categories').'</div>';      
                }
                unset($entry);
            ?>
        </div>
        <div class="cat-list" id="all_list" style="display: none;">
            <?
                foreach ($all as $entry) {
                echo '<div class="cat" data-category="'.$entry.'">'.locale($entry,$entry,'categories').'</div>';      
                }
            ?>
        </div>
    </div>
    <div id="launch-btn" style="display:none;"><i class="fas fa-play"></i></div>
    <div id="preset-launch-btn" style="display:none;" ><i class="fas fa-play"></i></div>
    <form id="launch-form" action="viewer.php" method="post" target="_blank" class="hidden">
        <input id="launch-input" type="hidden">
    </form>
</body>
</html>