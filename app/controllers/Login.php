<?php

class Login extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        $this->modelUsed = $this->model('AccountModel');
    }

    public function index(){
        if(!empty($_SESSION['user_username'])){
            $response = new Response();

            $response->redirect(_DEFAULT_PATH);
        }

        $this->data['valid_msg'] = Session::flashGet('valid_msg');
        $this->data['valid_err'] = Session::flashGet('form_errors');
        $this->data['valid_old'] = Session::flashGet('form_inputs');
        $this->data['success_msg'] = Session::flashGet('success_msg');

        $this->render('login', $this->data);
    }

    public function handling(){
        $request = new Request();

        if($request->getMethod() == 'POST'){
            $_POST['username'] = trim($_POST['username']);
            $_POST['username'] = stripslashes($_POST['username']);
            $_POST['username'] = htmlspecialchars($_POST['username']);

            // Set rules
            $request->setRules([
                'username' => 'required|exist:users:username',
                'password' => 'required'
            ]);

            // Set msg
            $request->setMsg([
                'username.required' => 'Username field can not be empty!',
                'username.exist' => 'This username does not exist!',
                'password.required' => 'Password field can not be empty!'
            ]);

            // Run validation & create Respose obj
            $requestStatus = $request->validate();

            $response = new Response();

            if(!$requestStatus){
                Session::flashSet('valid_msg', 'Some of your inputs are not valid, check everything again!');

                $response->redirect(_DEFAULT_PATH.'/login');
            }else{
                global $_DATABASE;

                $input = 'username = "'.$_POST['username'].'" AND hash = "'.hash_hmac('sha256', $_POST['password'], 'netflop').'"';

                $temp = $_DATABASE->select($this->modelUsed->table, $input);

                $check = count($temp);

                if($check == 1){
                    $accStatus = $temp[0]['status'];

                    if($accStatus == 1){
                        Session::flashSet('login_msg', 'Login successfully!');

                        $temp = $temp[0];

                        unset($_SESSION['form_errors']);
                        if(!empty($_SESSION['form_inputs'])){
                            unset($_SESSION['form_inputs']);
                        }

                        $_SESSION['user_username'] = $temp['username'];
                        $_SESSION['user_hash'] = $temp['hash'];
                        $_SESSION['user_role'] = $temp['role'];
                        $_SESSION['user_email'] = $temp['email'];
                        $_SESSION['user_created_at'] = $temp['created_time'];
                        $_SESSION['user_fullname'] = $temp['fullname'];
                        $_SESSION['user_dob'] = $temp['dob'];
                        if(!empty($temp['favorite'])){
                            $_SESSION['user_fav'] = explode(',', $temp['favorite']);
                        }else{
                            $_SESSION['user_fav'] = [];
                        }

                        $response->redirect(_DEFAULT_PATH);
                    }else{
                        Session::flashSet('valid_msg', 'This account has been banned! Contact admin email (4zur3.com@gmail.com) for more detail or there are some mistakes.');

                        $response->redirect(_DEFAULT_PATH.'/login');
                    }
                }else{
                    Session::flashSet('valid_msg', 'Wrong password!');

                    $response->redirect(_DEFAULT_PATH.'/login');
                }
            }
        }
    }

}