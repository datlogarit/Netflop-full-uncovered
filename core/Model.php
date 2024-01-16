<?php

class Model extends Database{

    protected $db;

    public function __construct(){
        global $_DATABASE;
        $this->db = $_DATABASE;
    }

    public function getAll($table){
        $result = $this->db->select($table);

        return $result;
    }

}