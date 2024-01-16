<?php

class Register extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        $this->modelUsed = $this->model('AccountModel');
    }

    public function index(){
        $this->data['valid_msg'] = Session::flashGet('valid_msg');
        $this->data['valid_err'] = Session::flashGet('form_errors');
        $this->data['valid_old'] = Session::flashGet('form_inputs');

        $this->render('register', $this->data);
    }

    public function handling(){
        $request = new Request();

        if($request->getMethod() == 'POST'){
            $_POST['email'] = trim($_POST['email']);
            $_POST['email'] = stripslashes($_POST['email']);
            $_POST['email'] = htmlspecialchars($_POST['email']);
            $_POST['username'] = trim($_POST['username']);
            $_POST['username'] = trim($_POST['username'], '/');
            $_POST['username'] = stripslashes($_POST['username']);
            $_POST['username'] = htmlspecialchars($_POST['username']);

            // Set rules
            $request->setRules([
                'username' => 'required|min:5|max:49|unique:users:username',
                'password' => 'required|min:8|max:49',
                'cfm_password' => 'required|match:password',
                'email' => 'required|email|unique:users:email',
            ]);

            // Set msg
            $request->setMsg([
                'username.required' => 'Username field can not be empty!',
                'username.min' => 'Username must be or more than 5 chars!',
                'username.max' => 'Username must be or less than 49 chars!',
                'username.unique' => 'This username has been used!',
                'password.required' => 'Password field can not be empty!',
                'password.min' => 'Password must be or more than 8 chars!',
                'password.max' => 'Password must be or less than 49 chars!',
                'cfm_password.required' => 'Confirm password field can not be empty!',
                'cfm_password.match' => 'Confirm password does not match!',
                'email.required' => 'Email field can not be empty!',
                'email.email' => 'Must input valid email format!',
                'email.unique' => 'This email has been used!',
            ]);

            // Run validation & create Respose obj
            $requestStatus = $request->validate();

            $response = new Response();

            if(!$requestStatus){
                Session::flashSet('valid_msg', 'Some of your inputs are not valid, check everything again!');

                $response->redirect(_DEFAULT_PATH.'/register');
            }else{
                unset($_SESSION['form_errors']);
                unset($_SESSION['form_inputs']);

                global $_DATABASE;

                $input = [
                    'username'=> $_POST['username'],
                    'hash'=> hash_hmac('sha256', $_POST['password'], 'netflop'),
                    'email'=> $_POST['email'],
                ];

                $_DATABASE->insert($this->modelUsed->table, $input);

                Session::flashSet('success_msg', 'Successfully registered, you can login now!');

                $response->redirect(_DEFAULT_PATH.'/login');
            }
        }
    }

}