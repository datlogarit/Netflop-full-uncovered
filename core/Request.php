<?php

class Request{

    private $__rules = [], $__msg = [], $__errors = [];

    public function getMethod(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return 'GET';
        }elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
            return 'POST';
        }
    }

    public function setRules($rules){
        $this->__rules = $rules;
    }

    public function setMsg($msg){
        $this->__msg = $msg;
    }

    public function setErrors($fieldName, $ruleName){
        $this->__errors[$fieldName][$ruleName] = $this->__msg[$fieldName.'.'.$ruleName];
    }

    public function getErrors($fieldName = ''){
        if(!empty($this->__errors)){
            if(empty($fieldName)){
                foreach($this->__errors as $key => $value){
                    $returnErr[$key] = reset($value);
                }

                return $returnErr;
            }

            return reset($this->__errors[$fieldName]);
        }

        return false;
    }

    public function getInput(){
        $dataInput = [];

        if($this->getMethod() == 'GET'){
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        $dataInput[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else{
                        $dataInput[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if($this->getMethod() == 'POST'){
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        $dataInput[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else{
                        $dataInput[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        return $dataInput;
    }

    public function validate(){
        $status = true;

        if(!empty($this->__rules)){
            $data = $this->getInput();

            $this->__rules = array_filter($this->__rules);

            foreach($this->__rules as $fieldName => $rule){
                $rulePairArr = explode('|', $rule);

                foreach($rulePairArr as $rulePair){
                    $ruleName = null;
                    $ruleValue = null;

                    $ruleArr = explode(':', $rulePair);

                    $ruleName = reset($ruleArr);

                    if(count($ruleArr) > 1){
                        $ruleValue = end($ruleArr);
                    }

                    if($ruleName == 'required'){
                        if(empty(trim($data[$fieldName]))){
                            $this->setErrors($fieldName, $ruleName);

                            $status = false;
                        }
                    }

                    if($ruleName == 'min'){
                        if(strlen(trim($data[$fieldName])) < $ruleValue){
                            $this->setErrors($fieldName, $ruleName);

                            $status = false;
                        }
                    }

                    if($ruleName == 'max'){
                        if(strlen(trim($data[$fieldName])) > $ruleValue){
                            $this->setErrors($fieldName, $ruleName);

                            $status = false;
                        }
                    }

                    if($ruleName == 'email'){
                        if(!filter_var($data[$fieldName], FILTER_VALIDATE_EMAIL)){
                            $this->setErrors($fieldName, $ruleName);

                            $status = false;
                        }
                    }

                    if($ruleName == 'match'){
                        if(trim($data[$fieldName]) != trim($data[$ruleValue])){
                            $this->setErrors($fieldName, $ruleName);

                            $status = false;
                        }
                    }

                    if($ruleName == 'unique'){
                        if(!empty($ruleArr[1])){
                            $tableName = $ruleArr[1];
                        }

                        if(!empty($ruleArr[2])){
                            $fieldCheck = $ruleArr[2];
                        }

                        if(!empty($tableName) && !empty($fieldCheck)){
                            global $_DATABASE;

                            $temp = $_DATABASE->query('SELECT count(*) FROM '.$tableName.' WHERE '.$fieldCheck.' = "'.trim($data[$fieldName]).'"');
                            $temp = mysqli_fetch_array($temp);
                            
                            if(!empty($temp[0])){
                                $this->setErrors($fieldName, $ruleName);

                                $status = false;
                            }
                        }
                    }

                    if($ruleName == 'exist'){
                        if(!empty($ruleArr[1])){
                            $tableName = $ruleArr[1];
                        }

                        if(!empty($ruleArr[2])){
                            $fieldCheck = $ruleArr[2];
                        }

                        if(!empty($tableName) && !empty($fieldCheck)){
                            global $_DATABASE;

                            $temp = $_DATABASE->query('SELECT count(*) FROM '.$tableName.' WHERE '.$fieldCheck.' = "'.trim($data[$fieldName]).'"');
                            $temp = mysqli_fetch_array($temp);
                            
                            if(empty($temp[0])){
                                $this->setErrors($fieldName, $ruleName);

                                $status = false;
                            }
                        }
                    }

                    if($ruleName == 'match_old_password'){
                        $old_pass = $_SESSION['user_hash'];

                        $input_pass = hash_hmac('sha256', $data[$fieldName], 'netflop');

                        if($input_pass != $old_pass){
                            $this->setErrors($fieldName, $ruleName);

                            $status = false;
                        }
                    }

                    // Callback validate
                    if(preg_match('~^callback_(.+)~is', $ruleName, $callback)){
                        if(!empty($callback[1])){
                            $callbackName = $callback[1];
                            $controler = App::$app->getCurController();

                            if(method_exists($controler, $callbackName)){
                                $checkCallback = call_user_func_array([$controler, $callbackName], [$data[$fieldName]]);
                                if(!$checkCallback){
                                    $this->setErrors($fieldName, $ruleName);

                                    $status = false;
                                }
                            }
                        }
                    }
                }
            }
        }

        Session::flashSet('form_errors', $this->getErrors());
        Session::flashSet('form_inputs', $this->getInput());

        return $status;
    }

}