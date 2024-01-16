<?php

class Account extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        if(empty($_SESSION['user_username'])){
            $response = new Response();

            $response->redirect(_DEFAULT_PATH);
        }

        $this->data['info_valid_msg'] = Session::flashGet('info_valid_msg');
        $this->data['email_valid_msg'] = Session::flashGet('email_valid_msg');
        $this->data['repass_valid_msg'] = Session::flashGet('repass_valid_msg');
        $this->data['valid_err'] = Session::flashGet('form_errors');
        $this->data['valid_old'] = Session::flashGet('form_inputs');

        if(!empty($_SESSION['user_username'])){
            $this->data['user_notifications'] = Helper::getNotifications();

            if(!empty($this->data['user_notifications'])){
                $this->data['user_notifications_vol'] = count($this->data['user_notifications']);
            }
        }

        // echo 'Your infomations:';

        // echo '<pre style="color: white;">';
        // print_r($_SESSION);
        // echo '</pre>';

        $this->render('account', $this->data);
    }

    public function edit_info(){
        $request = new Request();

        if($request->getMethod() == 'POST'){
            $_POST['fullname'] = trim($_POST['fullname']);
            $_POST['fullname'] = stripslashes($_POST['fullname']);
            $_POST['fullname'] = htmlspecialchars($_POST['fullname']);

            // Set rules
            $request->setRules([
                'fullname' => 'required',
                'dob' => 'required'
            ]);

            // Set msg
            $request->setMsg([
                'fullname.required' => 'Fullname field can not be empty!',
                'dob.required' => 'Date of Birth field can not be empty!'
            ]);

            // Run validation & create Respose obj
            $requestStatus = $request->validate();

            $response = new Response();

            if(!$requestStatus){
                Session::flashSet('info_valid_msg', 'Some of your inputs are not valid, check everything again!');

                $response->redirect(_DEFAULT_PATH.'/account');
            }else{
                unset($_SESSION['form_errors']);
                unset($_SESSION['form_inputs']);

                global $_DATABASE;

                $_DATABASE->update('users', $_POST, 'username = "'.$_SESSION['user_username'].'"');

                $_SESSION['user_fullname'] = $_POST['fullname'];
                $_SESSION['user_dob'] = $_POST['dob'];

                Session::flashSet('info_valid_msg', 'Successfully edited!');

                $response->redirect(_DEFAULT_PATH.'/account');
            }
        }
    }

    public function edit_email(){
        $request = new Request();

        if($request->getMethod() == 'POST'){
            $_POST['email'] = trim($_POST['email']);
            $_POST['email'] = stripslashes($_POST['email']);
            $_POST['email'] = htmlspecialchars($_POST['email']);

            // Set rules
            $request->setRules([
                'email' => 'required|email|unique:users:email'
            ]);

            // Set msg
            $request->setMsg([
                'email.required' => 'Email field can not be empty!',
                'email.email' => 'Must input valid email format!',
                'email.unique' => 'This email has been used!'
            ]);

            // Run validation & create Respose obj
            $requestStatus = $request->validate();

            $response = new Response();

            if(!$requestStatus){
                Session::flashSet('email_valid_msg', 'Your input is not valid, check everything again!');

                $response->redirect(_DEFAULT_PATH.'/account');
            }else{
                unset($_SESSION['form_errors']);
                unset($_SESSION['form_inputs']);

                global $_DATABASE;

                $_DATABASE->update('users', $_POST, 'username = "'.$_SESSION['user_username'].'"');

                $_SESSION['user_email'] = $_POST['email'];

                Session::flashSet('email_valid_msg', 'Successfully edited!');

                $response->redirect(_DEFAULT_PATH.'/account');
            }
        }
    }

    public function edit_password(){
        $request = new Request();

        if($request->getMethod() == 'POST'){
            // Set rules
            $request->setRules([
                'password' => 'required|min:8|max:49',
                'cfm_password' => 'required|match:password',
                'old_password' => 'required|match_old_password'
            ]);

            // Set msg
            $request->setMsg([
                'password.required' => 'New Password field can not be empty!',
                'password.min' => 'New Password must be or more than 8 chars!',
                'password.max' => 'New Password must be or less than 49 chars!',
                'cfm_password.required' => 'Confirm password field can not be empty!',
                'cfm_password.match' => 'Confirm password does not match!',
                'old_password.required' => 'Old Password field can not be empty!',
                'old_password.match_old_password' => 'Old Password does not match!',
            ]);

            // Run validation & create Respose obj
            $requestStatus = $request->validate();

            $response = new Response();

            if(!$requestStatus){
                Session::flashSet('repass_valid_msg', 'Some of your inputs are not valid, check everything again!');

                $response->redirect(_DEFAULT_PATH.'/account');
            }else{
                unset($_SESSION['form_errors']);
                unset($_SESSION['form_inputs']);

                $new_hash = hash_hmac('sha256', $_POST['password'], 'netflop');

                global $_DATABASE;

                $_DATABASE->update('users', ['hash' => $new_hash], 'username = "'.$_SESSION['user_username'].'"');

                $_SESSION['user_hash'] = $new_hash;

                Session::flashSet('repass_valid_msg', 'Successfully updated your password!');

                $response->redirect(_DEFAULT_PATH.'/account');
            }
        }
    }

}