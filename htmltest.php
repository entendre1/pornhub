<?

function vardump($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
  }
function ekho($var){
    echo '<pre>'.htmlspecialchars($var).'</pre>', PHP_EOL;
}
include './api/pq.php';

$opts = array('http' =>
    array(
        'user_agent' => 'Mozilla/5.0 (Linux; Android 8.0.0; Pixel 2 XL Build/OPD1.170816.004) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Mobile Safari/537.36',
        'method' => 'GET',
        'cookie' => 'bs=mm5u9jkqdtb4mn0fkajgi758fypq5on3; ss=507611426022548199; lang=ru; RNLBSERVERID=ded6829; ua=faf75111fc1323b5978c37e1c5654766; platform_cookie_reset=mobile; platform=mobile',
        'header' => 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'.
                    'Accept-Encoding: gzip, deflate, br'.
                    'Accept-Language: ru,en-US;q=0.9,en;q=0.8,ru-RU;q=0.7'.
                    'Connection: keep-alive'.
                    'Cookie: bs=mm5u9jkqdtb4mn0fkajgi758fypq5on3; ss=507611426022548199; lang=ru; RNLBSERVERID=ded6829; ua=97fc230848bc304ccee289a55f3e5339; platform_cookie_reset=pc; platform=pc'.
                    'DNT: 1'.
                    'Host: www.pornhub.com'.
                    'Referer: https://www.pornhub.com'.
                    'Sec-Fetch-Dest: iframe'.
                    'Sec-Fetch-Mode: navigate'.
                    'Sec-Fetch-Site: cross-site'.
                    'Upgrade-Insecure-Requests: 1'.
                    'User-Agent: Mozilla/5.0 (Linux; Android 8.0.0; Pixel 2 XL Build/OPD1.170816.004) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Mobile Safari/537.36'

    )
);
$context = stream_context_create($opts);
$file = file_get_contents('https://www.pornhub.com/embed/ph568908a4ca079');

$dom1 = new DOMDocument();
$dom1->loadHTML(html_entity_decode($file));
//$dom = phpQuery::newDocument($file);
//$element = $dom->find('script');
$scripts = $dom1->getElementsByTagName('script');
$script = $scripts[5]->nodeValue;

$temp = explode("[2];",$script);
$temp1 = $temp[1];
$len = strlen($temp1);
$tokens = array();

//SPLITTING
for ($i=0; $i<$len; $i++){
    if (substr($temp1,$i,4) == 'var '){
        $j = $i;
        while(true){
            if ($temp1[$j] == ';'){
                array_push($tokens,substr($temp1,$i+4,$j-$i-4));
            break;
            }   
            $j++;
        }
    }
}

//UNUSED LAST 2
unset($tokens[count($tokens)-1]);
unset($tokens[count($tokens)-1]);

//FINDING VIDEO TYPES - SPLITTING PREPARATION
//MP4480P HLS480P HLSARRAY
for ($i=0; $i<count($tokens); $i++){
    if (substr($tokens[$i],0,7)  == 'mp4480p'){
        $MP4480P = $tokens[$i];
        $MP4480Pi = $i;
    }
    if (substr($tokens[$i],0,7)  == 'hls480p'){
        $HLS480P = $tokens[$i];
        $HLS480Pi = $i;
    }
    if (substr($tokens[$i],0,8)  == 'hlsArray'){
        $HLSARRAY = $tokens[$i];
        $HLS480Pi = $i;
    }
}
//DELETING ARIPHMETICAL
unset($tokens[$MP4480Pi]);
unset($tokens[$HLS480Pi]);
unset($tokens[$HLSARRAYi]);
//COMPARE ARRAY PREPARATION
$variables = array();
for ($i=0; $i<count($tokens); $i++){
    $key = ''; $value = '';
    $current = $tokens[$i];
    $name_trigger = true;
    $value_trigger = false;
    for ($j=0; $j<strlen($current); $j++){
        if ( $current[$j] == '=' ){
            $name_trigger = false;
        }
        if ($name_trigger){
            $key.=$current[$j];
        } else {
            if ( $current[$j] == '"' ) {
                $value_trigger = !$value_trigger;
            } else {
                if ($value_trigger){
                    $value .= $current[$j];
                }
            }
            
        }
    }
    $variables[$key] = $value;
    $name_trigger = true;
    $value_trigger = false;
    unset($key);
    unset($value);
}


//COMMENTS DELETING
$emit = '';
$comment_trigger = true;
$current = $MP4480P;
for ($i=0; $i<strlen($MP4480P); $i++){
    //oncomment
    if ((substr($current,$i,2) == '/*') || (substr($current,$i,2) == '*/')) {
        $comment_trigger = !$comment_trigger;
    } else {
        if (($comment_trigger) && ($current[$i] != '/')){
            $emit .= $current[$i];
        }
    }
}
$emit = substr($emit,8,count($emit)-8);

$patterns = explode(' + ',$emit);

$url = '';
foreach ($patterns as $pattern) {
    $url.=$variables[$pattern];
}

vardump(urldecode($url));

//ekho(htmlspecialchars($file));



?>