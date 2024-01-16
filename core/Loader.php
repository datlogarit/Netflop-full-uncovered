<?php

class Load{

    static public function model($model){
        if(file_exists('app/models/'.$model.'.php')){
            require_once 'app/models/'.$model.'.php';
            if(class_exists($model)){
                $model = new $model();
                return $model;
            }
        }
        else{
            return false;
        }
    }

    static public function view($view, $data = []){
        if(!empty($data)){
            extract($data);
        }

        if(file_exists('app/views/'.$view.'.php')){
            require_once 'app/views/'.$view.'.php';
        }
    }

}