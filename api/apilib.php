<?
//include "db.php";
include 'phapi/phapi.php';
function getImplementingClasses( $interfaceName ) {
    return array_filter(
        get_declared_classes(),
        function( $className ) use ( $interfaceName ) {
            return in_array( $interfaceName, class_implements( $className ) );
        }
    ); 
}


interface IAction{
    public function Response();
    public function __construct($inputData);
}

class Response{
    private $DATA = array( 
        "status" => ""
    );
    public function __construct($status = "error",$data,$error_msg = "unexpected_error"){
        switch ($status){
            case "success":
                $this->$DATA["status"] = "success";
                $this->$DATA+=["data" => $data];
            break;
            case "error":
                $this->$DATA["status"] = "error";
                $this->$DATA+=["description" => $error_msg];
            break;
            default: 
                $this->$DATA["status"] = "error";
                $this->$DATA+=["description" => $error_msg];
        }
    }
    public function getData(){
        return $this->$DATA;
    }
}

class Action{
    protected $data = array("key" => "value");

    protected $response;
    public function __construct($data){
        $this->$response = new Response("success",$data,"");
    }
    public function Response(){
        if ( isset($this->$response) && ($this->$response instanceof Response) ) {    
            return $this->$response; 
        } else {
            return new Response("error",null,"action_execution_error");
        }
        
    }
}
function PHFK($embed){
    $opts = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>`Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
          Accept-Encoding: gzip, deflate, br
          Accept-Language: ru,en-US;q=0.9,en;q=0.8,ru-RU;q=0.7
          Connection: keep-alive
          Cookie: bs=mm5u9jkqdtb4mn0fkajgi758fypq5on3; ss=507611426022548199; lang=ru; RNLBSERVERID=ded6829; ua=97fc230848bc304ccee289a55f3e5339; platform_cookie_reset=pc; platform=pc
          DNT: 1
          Host: www.pornhub.com
          Referer: www.pornhub.com
          Sec-Fetch-Dest: iframe
          Sec-Fetch-Mode: navigate
          Sec-Fetch-Site: cross-site
          Upgrade-Insecure-Requests: 1
          User-Agent: Mozilla/5.0 (Linux; Android 8.0.0; Pixel 2 XL Build/OPD1.170816.004) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Mobile Safari/537.36
          X-Forwarded-For: 203.0.113.195
          REMOTE_ADDR: 203.0.113.195`
        )
      );
      
      $context = stream_context_create($opts);
      
    $file = file_get_contents($embed,false,$context);
    $dom1 = new DOMDocument();
    $dom1->loadHTML(html_entity_decode($file));
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

    $emit = explode('mp4480p=', $emit)[1];
    $patterns = explode(' + ',$emit);

    $url = '';
    foreach ($patterns as $pattern) {
        $url.=$variables[$pattern];
    }
    return $url;
}
/*class InternalApiExecutor{
    function __construct($action,$PARAMS){
        include 'apilib.php';

        use Noxyra\PornhubApi\Api\PornhubApi as PornhubApi;
        foreach (glob("./actions/*.php") as $filename)
        {
            include $filename;
        } 
        $DATA = $PARAMS;
        $classes= getImplementingClasses("IAction"); 

        $actionList = Array();
        foreach ($classes as $class){
            $actionList += [$class::$actionName => $class];
        }
        if (array_key_exists($DATA['action'],$actionList)){
            $action = new $actionList[$DATA['action']]($DATA);
            $response = $action->Response();
            if ( isset($response) && ($response instanceof Response) ) {
                echo json_encode($response->getData());
            } else {
                $response = new Response("error",null,"action_execution_error");
                echo json_encode($response->getData());
            }
        }else{
            $response = new Response("error",null,"no_such_action");
            echo json_encode($response->getData());
        }
    }
}*/
?>