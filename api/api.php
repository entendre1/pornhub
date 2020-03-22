<?
/**
 * PHRandomizer API
 * @version 1.2.2
 *  
 */
header('Content-Type: text/html; charset=utf-8');
include 'apilib.php';


use Noxyra\PornhubApi\Api\PornhubApi as PornhubApi;
foreach (glob("./actions/*.php") as $filename)
{
    include $filename;
} 
$DATA = $_GET;
$classes= getImplementingClasses("IAction"); 
$actionList = Array();
foreach ($classes as $class){
    $actionList += [$class::$actionName => $class];
}
if (array_key_exists($DATA['action'],$actionList)){
    $action = new $actionList[$DATA['action']]($DATA);
    $response = $action->Response();
    if ( isset($response) && ($response instanceof Response) ) {
        if ($actionList[$DATA['action']]::$outputType == 'html'){
           // echo 'hui';
            echo $response->getData()["data"];
        }else{
            //echo 'ne-hui';
            echo json_encode($response->getData());
            
        }
        
        
    } else {
        $response = new Response("error",null,"action_execution_error");
        echo json_encode($response->getData());
    }
}else{
    $response = new Response("error",null,"no_such_action");
    echo json_encode($response->getData());
}
?>