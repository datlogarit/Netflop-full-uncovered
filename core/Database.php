<?php

class Database{

    private $__connect = null;

    function __construct(){
        global $config;

        $db_host = $config['database']['host'];
        $db_username = $config['database']['user'];
        $db_password = $config['database']['pass'];
        $db_name = $config['database']['db'];

        try{
            $this->__connect = mysqli_connect($db_host, $db_username, $db_password, $db_name);
        }catch(Exception $e){
            $msg = $e->getMessage();
            $data['msg'] = $msg;
            App::$app->errorRp('exception', $data);
            die();
        }
    }

    function __disconnect(){
        mysqli_close($this->__connect);
    }

    public function query($query){
        try{
            $result = mysqli_query($this->__connect, $query);

            return $result;
        }catch(Exception $e){
            $msg = $e->getMessage();
            $data['msg'] = $msg;
            App::$app->errorRp('exception', $data);
            die();
        }
    }

    public function insert($table, $data){
        $fields = null;
        $inputs = null;

        if(!empty($data)){
            foreach($data as $key => $value){
                $value = mysqli_real_escape_string($this->__connect, $value);
                $fields .= $key.',';
                $inputs .= '"'.$value.'",';
            }

            $fields = rtrim($fields, ',');
            $inputs = rtrim($inputs, ',');

            $sql_query = 'INSERT INTO '.$table.'('.$fields.') VALUES('.$inputs.')';
            
            $result = $this->query($sql_query);

            if($result){
                // echo "<br>[mySQL] Successfully added data to mySQL!";
            }
        }
    }

    public function update($table, $data, $condition = ''){
        $inputs = null;

        if(!empty($data)){
            foreach($data as $key => $value){
                $value = mysqli_real_escape_string($this->__connect, $value);
                $inputs .= $key.'="'.$value.'",';
            }
            $inputs = rtrim($inputs, ',');

            if(!empty($condition)){
                $sql_query = 'UPDATE '.$table.' SET '.$inputs.' WHERE '.$condition;
            }else{
                $sql_query = 'UPDATE '.$table.' SET '.$inputs;
            }
            
            $result = $this->query($sql_query);

            if($result){
                // echo "<br>[mySQL] Successfully updated!";
            }
        }
    }

    public function delete($table, $condition = ''){
        if(!empty($condition)){
            $sql_query = 'DELETE FROM '.$table.' WHERE '.$condition;
        }else{
            $sql_query = 'DELETE FROM '.$table;
        }
            
        $result = $this->query($sql_query);

        if($result){
            // echo "<br>[mySQL] Successfully deleted!";
        }
    }

    public function select($table, $condition = ''){
        if(!empty($condition)){
            $sql_query = 'SELECT * FROM '.$table.' WHERE '.$condition;
        }else{
            $sql_query = 'SELECT * FROM '.$table;
        }
            
        $result = $this->query($sql_query);

        if($result){
            // echo "<br>[mySQL] Successfully select!";

            $output = mysqli_fetch_all($result, MYSQLI_ASSOC);

            return $output;
        }
    }

}