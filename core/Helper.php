<?php

class Helper{

    public static function getNotifications(){
        if(empty($_SESSION['user_username'])){
            return null;
        }else{
            global $_DATABASE;

            $returningNot = [];

            $allNot = $_DATABASE->select('notifications');

            if(empty($_SESSION['user_fav'])){
                return null;
            }

            foreach($allNot as $index => $notification){
                foreach($_SESSION['user_fav'] as $user_fav){
                    if($notification['post_id'] == $user_fav){
                        array_push($returningNot, $allNot[$index]);
                    }
                }
            }

            foreach($returningNot as $index => $notification){
                $read_by = explode('/_____/', $notification['read_by']);

                if(count($read_by) == 1){
                    if($read_by[0] == $_SESSION['user_username']){
                        unset($returningNot[$index]);
                    }
                }elseif(count($read_by) > 1){
                    foreach($read_by as $person){
                        if($person == $_SESSION['user_username']){
                            unset($returningNot[$index]);
                            break;
                        }
                    }
                }
            }
            
            if(!empty($returningNot)){
                $returningNot = array_values($returningNot);
            }

            foreach($returningNot as $index => $notification){
                if($notification['triggered_by'] == $_SESSION['user_username']){
                    unset($returningNot[$index]);
                }
            }

            return $returningNot;
        }
    }

    public static function getReports(){
        if($_SESSION['user_role'] != 'admin'){
            return null;
        }else{
            global $_DATABASE;

            $reports = [];

            $allReports = $_DATABASE->select('reports');

            foreach($allReports as $item){
                if($item['is_solved'] == 0){
                    array_push($reports, $item);
                }
            }

            return $reports;
        }
    }

    public static function getUsers($username = ''){
        if($_SESSION['user_role'] != 'admin'){
            return null;
        }else{
            global $_DATABASE;

            if(empty($username)){
                $users = $_DATABASE->select('users');
            }else{
                $users = $_DATABASE->select('users', 'username LIKE "%'.$username.'%"');
            }

            return $users;
        }
    }

}