<?php

class Search extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        global $_TMDB;

        if(!empty($_GET['keyword'])){
            $temp = $_TMDB->multiSearch($_GET['keyword']);

            foreach($temp as $type => $datas){
                $this->data['result_'.$type] = $datas;
            }
        }

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('search', $this->data);
    }

}