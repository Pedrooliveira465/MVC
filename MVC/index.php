<?php 
    require __DIR__ .'/vendor/autoload.php';
    use \app\controler\pages\home;
    use \app\http\response;
    use \app\http\router;
    define('URL', 'http://localhost/MVC');
    $a = new router(URL);
    $a -> get('/', [
        function(){
            return new response(200, home::gethome());
        }
    ]);