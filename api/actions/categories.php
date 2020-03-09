<?
use Noxyra\PornhubApi\Api\PornhubApi as PornhubApi;
/**
 * API METHOD: Categories
 * Can be called by: 'cats'
 * 
 */
class Categories extends Action implements IAction{
    public function vardump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
      }
    public static $actionName = 'cats';

    /**
     * Constructor: Categories
     * 
     */
    public function __construct($DATA){
        $PORNHUB = new PornhubApi();
        $res = array();
        $results = $PORNHUB->getCategoriesList();
        echo '<pre>';
        $results = $results->categories;
        foreach ($results as $result) {
            $res+=[$result->category => $result->id];
        }
        
        //var_dump();
        echo json_encode($res);
        echo '</pre>';
        /*
        {"180-1":"622","2d":"632","360-1":"612","3d":"642","60fps-1":"105","amateur":"3","amateur-gay":"252","anal":"35","arab":"98","asian-gay":"48","asian":"1","babe":"5","babysitter":"89","bareback-gay":"40","bbw":"6","bear-gay":"66","behind-the-scenes":"141","big-ass":"4","big-dick":"7","big-dick-gay":"58","big-tits":"8","bisexual-male":"76","black-gay":"44","blonde":"9","blowjob-gay":"56","blowjob":"13","bondage":"10","brazilian":"102","british":"96","brunette":"11","bukkake":"14","cartoon":"86","cartoon-gay":"422","casting-gay":"362","casting":"90","celebrity":"12","chubby-gay":"392","closed-captions-gay":"742","closed-captions":"732","college-gay":"68","college":"79","compilation":"57","compilation-gay":"382","cosplay":"241","creampie":"15","creampie-gay":"71","cuckold":"242","cumshot-gay":"352","cumshot":"16","czech":"100","daddy-gay":"47","described-video":"231","double-penetration":"72","ebony":"17","euro-gay":"46","euro":"55","exclusive":"115","feet":"93","feet-gay":"412","female-orgasm":"502","fetish-gay":"52","fetish":"18","ffm":"761","fingering":"592","fisting":"19","fmm":"771","french":"94","funny":"32","gangbang":"80","gay":"63","german":"95","group-gay":"62","handjob-gay":"262","handjob":"20","hardcore":"21","hd-porn":"38","hd-porn-gay":"107","hentai":"36","hunks-gay":"70","indian":"101","interactive":"108","interracial-gay":"64","interracial":"25","italian":"97","japanese":"111","japanese-gay":"39","jock-gay":"322","korean":"103","latina":"26","latino-gay":"50","lesbian":"27","massage-gay":"45","massage":"78","masturbation":"22","mature-gay":"332","mature":"28","milf":"29","military-gay":"402","muscle-gay":"51","muscular-men":"512","music":"121","old-young":"181","orgy":"2","parody":"201","party":"53","pissing":"211","popular-with-women":"73","pornstar":"30","pornstar-gay":"60","pov":"41","pov-gay":"372","pov-1":"702","public":"24","public-gay":"84","pussy-licking":"131","reality":"31","reality-gay":"85","red-head":"42","role-play":"81","romantic":"522","rough-sex-gay":"312","rough-sex":"67","russian":"99","school":"88","scissoring":"532","sfw":"221","small-tits":"59","smoking":"91","solo-female":"492","solo-male":"92","solo-male-gay":"54","squirt":"69","step-fantasy":"444","straight-guys-gay":"82","strap-on":"542","striptease":"33","tattooed-men-gay":"552","tattooed-women":"562","teen":"37","threesome":"65","toys":"23","trans-male":"602","trans-with-girl":"572","trans-with-guy":"582","transgender":"83","twink-gay":"49","uncensored":"712","uncensored-1":"722","uncut-gay":"272","verified-amateurs-gay":"731","verified-amateurs":"138","verified-couples":"482","verified-models":"139","vintage":"43","vintage-gay":"77","vr":"104","vr-gay":"106","voyeur":"682","webcam":"61","webcam-gay":"342"} */
        
    }
}