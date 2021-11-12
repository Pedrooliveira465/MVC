<?php
    namespace app\http;
    class response{
        private $httpcode = 200;
        private $headers = [];
        private $contenttype = "text\html";
        private $content;

        public function __construct($httpcode, $content, $contenttype = "text\html"){
            $this->httpcode = $httpcode;
            $this->content = $content;
            $this->setcontenttype = $contenttype;
        }
        public function setcontenttype($contenttype){
            $this->contenttype = $contenttype;
            $this->addheader("content-type", $contenttype);
        }
        public function addheader($keys, $values){
            $this->headers[$keys] = $values;
        }
        private function sendheaders(){
            http_response_code($this->httpcode);
            foreach ($this->headers as $keys => $value) {
                header($keys.':', $values.':');
            }
        }

        public function sendresponse(){
            $this->sendheaders();
            switch ($this->contenttype) {
                case 'text\html':
                    echo $this->content;
                    exit;
            }
        }
    }