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

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($strength = 16) {
    $input = $permitted_chars;
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
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