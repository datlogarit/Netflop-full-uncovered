<?php

class Session{

    static public function set($key, $data){
        $_SESSION[$key] = $data;
    }

    static public function get($key = ''){
        if(!empty($key)){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
        }else{
            if(isset($_SESSION)){
                return $_SESSION;
            }
        }
    }

    static public function delete($key = ''){
        if(!empty($key)){
            if(isset($_SESSION[$key])){
                unset($_SESSION[$key]);
            }
        }else{
            unset($_SESSION);
        }
    }

    // Flash data
    static public function flashSet($key, $data){
        self::set($key, $data);
    }

    static public function flashGet($key){
        $output = self::get($key);

        self::delete($key);

        return $output;
    }

}