<?php 
    require __DIR__ .'/vendor/autoload.php';
    use \app\controler\pages\home;
    use \app\http\response;
    use \app\http\router;

   define('URL', 'http://localhost/MVC');

    $obresponse = new router(URL);

//Rota home
    $obresponse -> get('/', [
        function(){
            return new response(200, home::gethome());
        }
    ]);
 //Imprime o response da rota 
    $obresponse->run();
                //->sendresponse();