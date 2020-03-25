<?
    use Noxyra\PornhubApi\Api\PornhubApi as PornhubApi;
    /** 
     * API Method - Random
     * Return Embed code of random video choosen from given categories
     * @version 1.0.12
     */
    class Random extends Action implements IAction{
        private function vardump($var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
          }
        /**
         * Action is being called by this name
         */
        public static $actionName = "search";
        
        /**
         * Limit for the first N pages randomizer chooses from
         */
        private const PAGES_LIMIT = 100;

        private static $j; 
        private $d;

        /**
         * List of all existing categories
         */
        private $library;
        
        /**
         * Chooses random category from categories in $library
         * @param array $exclude If given, this categories exclude from library
         * @return string Category 
         */
        private function randomCat($exclude = array()){
            $cats = array_diff($this->library,$exclude);
            $result = $cats[array_rand($cats)];
            return (string)$result;
        }

        /**
         * Chooses random category from categories in given library
         * @param array $include Categories is being choosen from this array
         * @return string Category 
         */
        private function randomCatFrom($include){
            $result = $include[array_rand($include)];
            return (string)$result;
        }

        /**
         * Returns random page number from 0 to PAGE_LIMIT
         * @return string Category 
         */
        private function randomPage(){
            $result = rand(1,Random::PAGES_LIMIT);
            return (int)$result;
        }



        public function __construct($data){

            $this->library = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/cats.data'))->all;
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
            $new = explode('allowfullscreen',$embed->embed->code);

            $new[0].='allowfullscreen sandbox="allow-scripts allow-same-origin allow-forms allow-modals allow-presentation allow-top-navigation"></iframe>';
            
            $this->$response = new Response ("success", $new[0], null);
        }
    }
?>  