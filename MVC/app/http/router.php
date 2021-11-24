<?php
 namespace app\http;

 use \Closure;
 use \Exception;
 use \app\http\request;

 class router{

    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;

    public function __construct($url){

        $this->request = new request();
        $this->url = $url;
        $this->setprefix();
        
    }

/** Aqui é o setprefix */
    private function setprefix(){

        $parseurl = parse_url($this->url);
        $this->prefix = $parseurl['path'] ?? '';
    }

/** Aqui é o addroute */
    private function addroute($method, $route, $params = []){

        foreach ($params as $keys => $values) {
            if($values instanceof Closure){
                $params['controller'] = $values;
                unset($params[$keys]);
                continue;
            }
        }
        $paternroute = '/^'.str_replace('/', '\/', $route).'$/';
        $this->routes[$paternroute] [$method] = $params;
        
    }

/** Aqui é o get*/
    public function get($route, $params = []){

        return $this->addroute('GET', $route, $params);

    }

    public function post($route, $params = []){

        return $this->addroute('POST', $route, $params);

    }

    public function put($route, $params = []){

        return $this->addroute('PUT', $route, $params);

    }

    public function delete($route, $params = []){

        return $this->addroute('DELETE', $route, $params);

    }

/** Aqui é o geturi */
    private function geturi(){

        $uri = $this->request->geturi();
        $strlen = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($strlen);

        
    }

/** Aqui é getroute */
    private function getroute(){
        $uri = $this->geturi();
        $httpmethod = $this->request->gethttpmethod();

        /**Utilizando o foreach */
        foreach ($this->routes as $paternroute => $methods){
            /** Utilizando o preg_match */
            if (preg_match($paternroute, $uri)) {
                if($methods[$httpmethod]){
                    return $methods[$httpmethod];
                }

                 /**Utilizando o throw para o erro 405*/
                 throw new Exception("Error 405", 405);
            }
        }
            /**Utilizando o throew para o erro 404 */
            throw new Exception("Error 404", 404);
    }
    //MÉTODO QUE EXECUTA A ROTA ATUAL
    public function run () {
        try {
            //Obtém a rota atual
            $route = $this->getroute();

            //Verifica o controlador 
            if (!isset($route['controller'])) {
                throw new Exception("URl não pode ser processada", 500);

                //Parâmetros da função
                $args = [];

                //Retorna a execução da função
                return call_user_func_array($route['controller'], $args);
            }

        }catch(Exception $e) {
            return new response($e->getcode(), $e->getMessage());
        }
    }
 }