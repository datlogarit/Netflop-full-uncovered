<?php

class About extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('about-us', $this->data);
    }

}