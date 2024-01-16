<?php

class TVShows extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/tvshows/popular');
    }

    public function popular($page = 1){
        global $_TMDB;

        $this->data['head_title'] = 'Popular TV Shows &mdash; NetFlop';
        $this->data['title'] = 'Popular TV Shows';

        $this->data['page'] = $page;
        $this->data['type'] = 'popular';

        $this->data['tvs'] = $_TMDB->getPopularTVShows($page);

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('tvshows', $this->data);
    }

    public function top($page = 1){
        global $_TMDB;

        $this->data['head_title'] = 'Top Rated TV Shows &mdash; NetFlop';
        $this->data['title'] = 'Top Rated TV Shows';

        $this->data['page'] = $page;
        $this->data['type'] = 'top';

        $this->data['tvs'] = $_TMDB->getTopRatedTVShows($page);

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('tvshows', $this->data);
    }

    public function air($page = 1){
        global $_TMDB;

        $this->data['head_title'] = 'On The Air TV Shows &mdash; NetFlop';
        $this->data['title'] = 'On The Air TV Shows';

        $this->data['page'] = $page;
        $this->data['type'] = 'air';

        $this->data['tvs'] = $_TMDB->getOnTheAirTVShows($page);

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('tvshows', $this->data);
    }

}