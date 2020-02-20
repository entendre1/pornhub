<?
    use Noxyra\PornhubApi\Api\PornhubApi as PornhubApi;
    class Random extends Action implements IAction{
        private function vardump($var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
          }
        public static $actionName = "search";
        private const PAGES_LIMIT = 10;
        private $j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data' ); 
        private $d = json_decode($j);
        private $library = $d->{"all"};
        private function randomCat($exclude = array()){
            $cats = array_diff($this->library,$exclude);
            $result = $cats[array_rand($cats)];
            return (string)$result;
        }
        private function randomCatFrom($include){
            $result = $include[array_rand($include)];
            return (string)$result;
        }
        private function randomPage(){
            $result = rand(1,100);
            return (int)$result;
        }



        public function __construct($data){


            $PORNHUB = new PornhubApi();
            
            if(isset($data["excluded_cats"]) && isset($data["included_cats"])){
                //?) error
                $this->$response = new Response ("error", null, "wtf_incompatible_params");
                return;
            }else if (!isset($data["excluded_cats"]) && !isset($data["included_cats"])){
                //default - without preferences
                $results = $PORNHUB->searchVideos(
                    $this->randomPage(),
                    $this->randomCat()
                );
            }else if (isset($data["excluded_cats"])){
                //excluded
                $results = $PORNHUB->searchVideos(
                    $this->randomPage(),
                    $this->randomCat(explode(',',$data["excluded_cats"]))
                );
            }else if (isset($data["included_cats"])){
                //included
                    $results = $PORNHUB->searchVideos(
                        $this->randomPage(),
                        $this->randomCatFrom(explode(',',$data["included_cats"]))
                    );
            }
            
            $video = $results->videos[array_rand($results->videos)];
            $embed = $PORNHUB->getVideoEmbedCode($video->video_id);
            
            $this->$response = new Response ("success", $embed->embed->code, null);
        }
    }
?>  