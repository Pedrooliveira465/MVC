<?php
 namespace app\http;

 class router{

    private $url;
    private $prefix;
    private $routes = [];
    private $request;

    public function __construct($url){

        $this->request = new request();
        $this->url = $url;
        $this->setprefix();
        
    }

    public function setprefix(){

        $parseurl = parse_url($this->url);
        $this->prefix = $parseurl['path'] ?? '';
    }

    private function addroute($method, $route, $params = []){

        foreach ($params as $keys => $values) {
            
            if($values instanceof Closure){

                $params['Controller'] = $values;
                unset($params[$keys]);
                continue;
            }
        }
        $paternroute = '/^'.str_replace('/', '\/', $route).'$';
        $this->routes[$paternroute] [$method] = $params;
        
    }

    public function get($route, $params = []){

        $this->addroute('GET', $route, $params);

    }

    private function geturi(){

        $uri = $this->uri;
        $strlen = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($uri);

        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }

    private function getroute(){
        $uri = $this->geturi();
    }
 }
