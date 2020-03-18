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
    $file = file_get_contents($embed);
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