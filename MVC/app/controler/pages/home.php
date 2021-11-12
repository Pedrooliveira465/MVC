<?php
    namespace app\controler\pages;
    use \app\utils\view;
    use \app\model\entity\organization;
    class home extends page{

        /**
         * @return string
         */

        public static function gethome(){
            $org = new organization;
            $title = 'MVC';
            $content = view::render('pages/home', $arrays = array("name" => $org -> name, 
            "description" => $org -> description
        ));
            return parent::getpage($title, $content);
        }
    }