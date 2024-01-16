<?php

class Home extends Controller{

    public $data = [];

    public function __construct(){
        // $this->modelUsed = $this->model('HomeModel');
    }

    public function index(){
        global $_TMDB;

        $this->data['head_title'] = 'NetFlop - We know what you want to know';

        $temp = $_TMDB->getTopRatedMovies();
        $tempKeys = array_rand($temp, 8);
        foreach($tempKeys as $key){
            $this->data['movies_top'][] = $temp[$key];
        }

        $temp = $_TMDB->getUpcomingMovies();
        $tempKeys = array_rand($temp, 4);
        foreach($tempKeys as $key){
            $this->data['movies_upc'][] = $temp[$key];
        }

        $temp = $_TMDB->getTopRatedTVShows();
        $tempKeys = array_rand($temp, 8);
        foreach($tempKeys as $key){
            $this->data['tv_top'][] = $temp[$key];
        }

        $this->data['login_msg'] = Session::flashGet('login_msg');

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('home', $this->data);
    }

    public function logout(){
        session_unset();

        $response = new Response();

        $response->redirect(_DEFAULT_PATH);
    }

    public function remove_notification(){
        global $_DATABASE;

        $data = [];

        $temp = $_DATABASE->select('notifications', 'not_id = "'.$_POST['not_id'].'"')[0];

        if(empty($temp['read_by'])){
            $data = [
                'read_by' => $_SESSION['user_username']
            ];
        }else{
            $data = [
                'read_by' => $temp['read_by'].'/_____/'.$_SESSION['user_username']
            ];
        }

        $_DATABASE->update('notifications', $data, 'not_id = "'.$_POST['not_id'].'"');

        $response = new Response();

        $response->redirect($_POST['redirect_path']);
    }

}