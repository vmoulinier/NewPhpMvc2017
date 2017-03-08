<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 08/03/2017
 * Time: 23:06
 */

namespace App\Model;


class UserRepository
{

    public function getUserId(){
        if($this->islogged()){
            return $_SESSION['user_id'];
        }
        return false;
    }

    public function login($email, $password) {
        $req = SPDO::getInstance()->prepare('SELECT * FROM user WHERE email = :email');
        $req->execute(array(':email' => $email));
        $user = $req->fetch(\PDO::FETCH_OBJ);
        if($user){
            if($user->password == sha1($password)){
                $this->saveSession($user->id);
                return true;
            }
        }
        return false;
    }

    public function saveSession($id) {
        $_SESSION['user_id'] = $id;
    }

    public function islogged(){
        return isset($_SESSION['user_id']);
    }

}