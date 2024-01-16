<?php

class ChatGPT extends Controller{

    public $data = [], $modelUsed = null;

    public function __construct(){
        // Contruct func
    }

    public function index(){
        if(!empty($_SESSION['user_username'])){
            if(empty($_SESSION['chatgpt']['user_input'])){
                $_SESSION['chatgpt']['user_input'] = array();
            }

            if(empty($_SESSION['chatgpt']['gpt_result'])){
                $_SESSION['chatgpt']['gpt_result'] = array();
            }
        }

        $this->render('chatgpt');
    }

    public function handling(){
        global $config;

        $secretKey = $config['app']['openAIkey'];

        array_push($_SESSION['chatgpt']['user_input'], $_POST['body']);

        $data = [
            "model" => "gpt-3.5-turbo",
            'messages' => [
                [
                   "role" => "user",
                   "content" => $_POST['body']
               ]
            ],
            'temperature' => 0.5,
            "max_tokens" => 666,
            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            "stop" => ["11."],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$secretKey;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        
        curl_close($ch);

        $result = json_decode($response, JSON_OBJECT_AS_ARRAY);

        if(!empty($result['choices'][0]['message']['content'])){
            array_push($_SESSION['chatgpt']['gpt_result'], $result['choices'][0]['message']['content']);
        }else{
            array_push($_SESSION['chatgpt']['gpt_result'], 'Something gone wrong! I\'m sorry about that!');
        }

        $response = new Response();

        $response->redirect(_DEFAULT_PATH.'/chatgpt');
    }
}