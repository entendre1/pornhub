<?
class GetIFrame extends Action implements IAction{
    public static $actionName = 'getiframe';
    public static $outputType = 'html';
    public function __construct($DATA){
        if (isset($DATA['embed_link'])){
            $html = file_get_contents($DATA['embed_link']);
            $array = explode('</body>',$html);
            $inject = '<script>window.parent.postMessage(flashvars, "*");</script>';
            $html1 = $array[0].$inject.'</body></html>';
            $this->$response = new Response('success',html_entity_decode($html1));
        }else{
            $this->$response = new Response('error',null,'invalid_embed_link');
        }
    }
}



?>