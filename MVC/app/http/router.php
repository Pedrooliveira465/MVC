<?php
    namespace app\http;
    class router{
        private $url = 'http://localhost/mvc';
        private $prefix;
        private $route = [];
        private $request;

        public function __construct($url){
            $this->request = new request();
            $this->url = $url;
            $this->setprefix();
        }

        public function setprefix(){
            $parse_url = parse_url($this->url);
            $this->prefix = $parse_url['PATH'] ?? '';
        }

        private function addroute($method, $route, $params = []){
            foreach ($params as $keys => $values) {
                if ($value instanceof Closure) {
                    $params['Controller'] = $values;
                    unset($params[$keys]);
                    continue;
                }
            }
                $paternroute = '/^'.str_ireplace('/', '\/', $route).'$';
                $this->routes[$paternroute] [$method] = $params;
                echo '<pre>';
                print_r($this);
                echo '</pre>';
                

            }
            public function get($route, $params = []){
                $this->addroute('GET', $route, $params);
            }
        }