<?php
    namespace app\controler\pages;
    use \app\utils\view;
    class page{
        private static function getheader(){
            return view::render('pages/header');
        }

        private static function getfooter(){
            return view::render('pages/footer');
        }

        /**
         * @return string
         */

        public static function getpage($title, $content){
            return view::render('pages/page', [
            'title'=> $title, 
            'content' => $content,
            'header' => self::getheader(),
            'footer' => self::getfooter()
        ]);

        }
    }