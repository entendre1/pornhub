<?
//include "db.php";

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
            return $response;
        } else {
            return new Response("error",null,"action_execution_error");
        }
        
    }
}
?>