<?php

class Movies extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/movies/popular');
    }

    public function popular($page = 1){
        global $_TMDB;

        $this->data['head_title'] = 'Popular Movies &mdash; NetFlop';
        $this->data['title'] = 'Popular Movies';

        $this->data['page'] = $page;
        $this->data['type'] = 'popular';

        $this->data['movies'] = $_TMDB->getPopularMovies($page);

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('movies', $this->data);
    }

    public function top($page = 1){
        global $_TMDB;

        $this->data['head_title'] = 'Top Rated Movies &mdash; NetFlop';
        $this->data['title'] = 'Top Rated Movies';

        $this->data['page'] = $page;
        $this->data['type'] = 'top';

        $this->data['movies'] = $_TMDB->getTopRatedMovies($page);

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('movies', $this->data);
    }

    public function upcoming($page = 1){
        global $_TMDB;

        $this->data['head_title'] = 'Upcoming Movies &mdash; NetFlop';
        $this->data['title'] = 'Upcoming Movies';

        $this->data['page'] = $page;
        $this->data['type'] = 'upcoming';

        $this->data['movies'] = $_TMDB->getUpcomingMovies($page);

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('movies', $this->data);
    }

    public function genre($genreID = null, $page = 1){
        global $_TMDB;

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->data['title'] = 'Movies by Genre';

        $this->data['genres_list'] = $_TMDB->getMovieGenres();

        if(!empty($genreID)){
            $temp = $_TMDB->getMovieGenres();

            foreach($temp as $genre){
                if($genre->getID() == $genreID){
                    $genreName = $genre->getName();
                    break;
                }
            }

            if(!empty($genreName)){
                $this->data['title_with_genre_name'] = $genreName;
                $this->data['head_title'] = $genreName.' Movies &mdash; NetFlop';
                $this->data['movies'] = $_TMDB->getMoviesByGenre($genreID, $page);
                $this->data['genreID'] = $genreID;
                $this->data['page'] = $page;
                $this->data['type'] = 'genre';
            }else{
                App::$app->errorRp();
            }
        }else{
            $this->data['head_title'] = 'Movies by Genre &mdash; NetFlop';
        }

        $this->render('movies-genres', $this->data);
    }

}