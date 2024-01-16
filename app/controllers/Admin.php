<?php

class Admin extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        if($_SESSION['user_role'] == 'normal'){
            $response = new Response();

            $response->redirect(_DEFAULT_PATH);
        }

        $this->data['msg']['report_decline'] = Session::flashGet('report_decline_msg');
        $this->data['msg']['user_ban'] = Session::flashGet('user_ban_msg');

        $this->data['reports'] = Helper::getReports();

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('admin-reports', $this->data);
    }

    public function users_manage(){
        if($_SESSION['user_role'] == 'normal'){
            $response = new Response();

            $response->redirect(_DEFAULT_PATH);
        }

        $this->data['msg']['user_ban'] = Session::flashGet('user_ban_msg');
        $this->data['msg']['user_unban'] = Session::flashGet('user_unban_msg');
        $this->data['msg']['announcement'] = Session::flashGet('announcement_msg');

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        $this->render('admin-users', $this->data);
    }

    public function decline(){
        global $_DATABASE;

        $data = ['is_solved' => 1];

        $_DATABASE->update('reports', $data, 'report_id = "'.$_POST['report_id'].'"');

        Session::flashSet('report_decline_msg', 'That report has been declined!');

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/admin');
    }

    public function ban(){
        $report_data = ['is_solved' => 1];
        $users_data = ['status' => 0];

        global $_DATABASE;

        $_DATABASE->update('reports', $report_data, 'username = "'.$_POST['username'].'"');
        $_DATABASE->update('users', $users_data, 'username = "'.$_POST['username'].'"');
        $_DATABASE->delete('reviews', 'username = "'.$_POST['username'].'"');

        Session::flashSet('user_ban_msg', 'Successfully banned!');

        $response = new Response();

        $response->redirect($_POST['redirect_path']);
    }

    public function unban(){
        $users_data = ['status' => 1];

        global $_DATABASE;

        $_DATABASE->update('users', $users_data, 'username = "'.$_POST['username'].'"');

        Session::flashSet('user_unban_msg', 'Successfully unbanned!');

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/admin/users_manage');
    }

    public function send_announcement(){
        $notification = [
            'body' => '[ADMIN] '.trim($_POST['body']),
            'post_id' => 'admin',
            'triggered_by' => 'admin'
        ];

        global $_DATABASE;

        $_DATABASE->insert('notifications', $notification);

        Session::flashSet('announcement_msg', 'Successfully posted an announcement!');

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/admin/users_manage');
    }

}