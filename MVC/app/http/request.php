<?php
    namespace app\http;
    class http{
        private $httpmethod;
        private $uri;
        private $queryparemts = [];
        private $postvars = [];
        private $headers = [];
        public function __construct(){
            $this->queryparemts = $_GET ?? [];
            $this->postvars = $_POST ?? [];
            $this->headers = getallheaders();
            $this->httpmethod = $_SERVER['REQUEST_METHOD'];
            $this->uri = $_SERVER['REQUEST_URI'];

        }

        public function gethttpmethod(){
            return $this->httpmethod;
        }

        public function geturi(){
            return $this->uri;
        }

        public function getqueryparemts(){
            return $this->queryparemts;
        }

        public function getpostvars(){
            return $this->postvars;
        }

        public function getheaders(){
            return $this->headers;
        }
        
    }