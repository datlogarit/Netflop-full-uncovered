<?php

class Detail extends Controller{

    public $data = [];
    private $__commentTable = 'reviews', $__userTable = 'users', $__reportTable = 'reports', $__notTable = 'notifications';

    public function __construct(){
        // Contruct func
    }

    public function index(){
        $response = new Response();

        $response->redirect(_DEFAULT_PATH);
    }

    public function m($id = ''){
        if(empty($id)){
            $response = new Response();

            $response->redirect(_DEFAULT_PATH);
        }

        global $_TMDB;

        $detail = $_TMDB->getMovie($id);

        if(empty($detail->get())){
            App::$app->errorRp();
        }else{
            $releaseYear = $detail->get('release_date');
            $releaseYear = strtok($releaseYear, '-');
            $this->data['page_title'] = $detail->getTitle().' ('.$releaseYear.') &mdash; NetFlop';

            $this->data['detail'] = $detail;

            global $_DATABASE;

            $this->data['reviews'] = $_DATABASE->select($this->__commentTable, 'type = "m" and post_id = "'.$id.'"');

            $this->data['review_type'] = 'm';
            $this->data['review_id'] = $id;

            $this->data['review_submit_info'] = Session::flashGet('review_submit_msg');

            $this->data['fav_msg'] = Session::flashGet('fav_msg');
            $this->data['unfav_msg'] = Session::flashGet('unfav_msg');

            $this->data['is_favorited'] = false;
            if(!empty($_SESSION['user_fav'])){
                foreach($_SESSION['user_fav'] as $index => $item){
                    if($item == 'm/'.$id){
                        $this->data['is_favorited'] = true;
                        $this->data['fav_index'] = $index;
                        break;
                    }
                }
            }

            if(!empty($_SESSION['user_username'])){
                $this->data['user_notifications'] = Helper::getNotifications();
    
                if(!empty($this->data['user_notifications'])){
                    $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
                }
            }

            $this->render('detail-m', $this->data);
        }
    }

    public function tv($id = ''){
        if(empty($id)){
            $response = new Response();

            $response->redirect(_DEFAULT_PATH);
        }

        global $_TMDB;

        $detail = $_TMDB->getTVShow($id);

        if(empty($detail->get())){
            App::$app->errorRp();
        }else{
            $firstYear = $detail->get('first_air_date');
            $firstYear = strtok($firstYear, '-');
            $this->data['page_title'] = $detail->getName().' ('.$firstYear.') &mdash; NetFlop';

            $this->data['detail'] = $detail;

            global $_DATABASE;

            $this->data['reviews'] = $_DATABASE->select($this->__commentTable, 'type = "tv" and post_id = "'.$id.'"');

            $this->data['review_type'] = 'tv';
            $this->data['review_id'] = $id;

            $this->data['review_submit_info'] = Session::flashGet('review_submit_msg');

            $this->data['fav_msg'] = Session::flashGet('fav_msg');
            $this->data['unfav_msg'] = Session::flashGet('unfav_msg');

            $this->data['is_favorited'] = false;
            if(!empty($_SESSION['user_fav'])){
                foreach($_SESSION['user_fav'] as $index => $item){
                    if($item == 'tv/'.$id){
                        $this->data['is_favorited'] = true;
                        $this->data['fav_index'] = $index;
                        break;
                    }
                }
            }

            if(!empty($_SESSION['user_username'])){
                $this->data['user_notifications'] = Helper::getNotifications();
    
                if(!empty($this->data['user_notifications'])){
                    $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
                }
            }

            $this->render('detail-tv', $this->data);
        }
    }

    public function review_submit(){
        global $_DATABASE;

        global $_TMDB;

        $_DATABASE->insert($this->__commentTable, $_POST);

        $movie_title = '';

        if($_POST['type'] == 'm'){
            $movie_title = $_TMDB->getMovie($_POST['post_id'])->getTitle();
        }else{
            $movie_title = $_TMDB->getTVShow($_POST['post_id'])->getName();
        }

        $notification = [
            'body' => 'There is a new review about \''.$movie_title.'\', it\'s getting hot!',
            'post_id' => $_POST['type'].'/'.$_POST['post_id'],
            'triggered_by' => $_SESSION['user_username']
        ];

        $_DATABASE->insert($this->__notTable, $notification);

        Session::flashSet('review_submit_msg', 'Successfully posted your review!');

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
    }

    public function review_edit(){
        global $_DATABASE;

        $data = [
            'body' => $_POST['body'],
            'rating' => $_POST['rating']
        ];

        $_DATABASE->update($this->__commentTable, $data, 'review_id = "'.$_POST['review_id'].'"');

        Session::flashSet('review_submit_msg', 'Successfully edited your review!');

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
    }

    public function review_delete(){
        global $_DATABASE;

        $_DATABASE->delete($this->__commentTable, 'review_id = "'.$_POST['review_id'].'"');

        Session::flashSet('review_submit_msg', 'Successfully deleted review!');

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
    }

    public function report(){

        global $_DATABASE;

        $check = $_DATABASE->select($this->__reportTable, 'review_id = "'.$_POST['review_id'].'" AND reported_by = "'.$_SESSION['user_username'].'"');
        $check = count($check);

        if($check == 1){
            Session::flashSet('review_submit_msg', 'You have already reported this review!');

            $response = new Response();

            $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
        }else{
            $data = [
                'reason' => $_POST['reason'],
                'username' => $_POST['username'],
                'review_id' => $_POST['review_id'],
                'review_body' => $_POST['review_body'],
                'reported_by' => $_SESSION['user_username']
            ];
    
            $_DATABASE->insert($this->__reportTable, $data);
    
            Session::flashSet('review_submit_msg', 'Successfully report this review!');
    
            $response = new Response();
    
            $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
        }
    }

    public function favorite(){
        array_push($_SESSION['user_fav'], $_POST['type'].'/'.$_POST['post_id']);

        $_SESSION['user_fav'] = array_values($_SESSION['user_fav']);

        global $_DATABASE;

        if(count($_SESSION['user_fav']) == 1){
            $data = [
                'favorite' => $_SESSION['user_fav'][0]
            ];

            $_DATABASE->update($this->__userTable, $data, 'username = "'.$_SESSION['user_username'].'"');
        }else{
            $fav = implode(',', $_SESSION['user_fav']);

            $data = [
                'favorite' => $fav
            ];

            $_DATABASE->update($this->__userTable, $data, 'username = "'.$_SESSION['user_username'].'"');
        }

        Session::flashSet('fav_msg', 'Set favorite successfully!');

        $response = new Response();
    
        $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
    }

    public function unfavorite(){
        unset($_SESSION['user_fav'][$_POST['fav_index']]);

        $_SESSION['user_fav'] = array_values($_SESSION['user_fav']);

        global $_DATABASE;

        if(count($_SESSION['user_fav']) == 0){
            $data = [
                'favorite' => ''
            ];

            $_DATABASE->update($this->__userTable, $data, 'username = "'.$_SESSION['user_username'].'"');
        }elseif(count($_SESSION['user_fav']) == 1){
            $data = [
                'favorite' => $_SESSION['user_fav'][0]
            ];

            $_DATABASE->update($this->__userTable, $data, 'username = "'.$_SESSION['user_username'].'"');
        }else{
            $fav = implode(',', $_SESSION['user_fav']);

            $data = [
                'favorite' => $fav
            ];

            $_DATABASE->update($this->__userTable, $data, 'username = "'.$_SESSION['user_username'].'"');
        }

        Session::flashSet('unfav_msg', 'Set unfavorite successfully!');

        $response = new Response();
    
        $response->redirect(_DEFAULT_PATH.'/detail/'.$_POST['type'].'/'.$_POST['post_id']);
    }
}