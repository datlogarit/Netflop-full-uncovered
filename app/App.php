<?php

class App{

    private $__controller, $__action, $__params;

    static public $app;

    function __construct(){
        self::$app = $this;

        $this->__controller = 'home';
        $this->__action = 'index';
        $this->__params = [];

        $this->urlAnalyze();
    }

    function getUrl(){
        if(!empty($_SERVER['PATH_INFO'])){
            $url = $_SERVER['PATH_INFO'];
        }else{
            $url = '/';
        }

        return $url;
    }

    public function urlAnalyze(){
        $url = $this->getUrl();

        $urlArr = array_values(array_filter(explode('/',$url)));

        // Controller Handle
        if(!empty($urlArr[0])){
            $this->__controller = ucfirst($urlArr[0]);
        }else{
            $this->__controller = ucfirst($this->__controller);
        }

        if(file_exists('app/controllers/'.$this->__controller.'.php')){
            require_once 'controllers/'.$this->__controller.'.php';

            $this->__controller = new $this->__controller();

            unset($urlArr[0]);
        }else{
            $this->errorRp();
        }

        // Action / Method handle
        if(!empty($urlArr[1])){
            $this->__action = $urlArr[1];

            unset($urlArr[1]);
        }

        // Params handle
        $this->__params = array_values($urlArr);

        // Call method
        if(method_exists($this->__controller, $this->__action)){
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        }
        else{
            $this->errorRp();
        }
    }

    public function errorRp($error = '404', $data = []){
        if(!empty($data)){
            extract($data);
        }

        require_once 'views/errors/'.$error.'.php';
    }

    public function getCurController(){
        return $this->__controller;
    }

}