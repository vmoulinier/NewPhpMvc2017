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

    public function register($email, $password, $password_verif, $nom, $prenom) {
        $req = SPDO::getInstance()->query('SELECT * FROM user WHERE email = "' . $email . '"');
        $res = $req->rowCount();
        if($res == 0){
            if($password === $password_verif) {
                $password = sha1($password);
                $req = SPDO::getInstance()->prepare('INSERT INTO user (email, password, nom, prenom) VALUES(:email, :password, :nom, :prenom)');
                $req->bindParam(':email', $email);
                $req->bindParam(':password', $password);
                $req->bindParam(':nom', $nom);
                $req->bindParam(':prenom', $prenom);
                $req->execute();
                $error = 'Compte correctement enregistré !';
                return $error;
            } else {
                $error = 'Vos mots de passes sont différents.';
                return $error;
            }
        } elseif($res == 1) {
            $error = 'Email déjà utilisé.';
            return $error;
        } else {
            $error = 'Erreur inconnue.. Contactez Valentin Moulinier !';
            return $error;
        }
    }

    public function login($email, $password) {
        $req = SPDO::getInstance()->prepare('SELECT * FROM user WHERE email = :email');
        $req->execute(array(':email' => $email));
        $user = $req->fetch(\PDO::FETCH_OBJ);
        if($user){
            if($user->password == sha1($password)){
                if($user->type == 'ROLE_ADMIN'){
                    $this->saveSessionAdmin($user->id, $user->type);
                    return true;
                } else {
                    $this->saveSession($user->id);
                    return true;
                }
            }
        }
        return false;
    }

    public function saveSession($id) {
        $_SESSION['user_id'] = $id;
    }

    public function saveSessionAdmin($id, $role) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_role'] = $role;
    }

    public function islogged(){
        if(isset($_SESSION['user_id'])) {
            return true;
        }
    }

    public function isloggedAdmin(){
        if(isset($_SESSION['user_id']) and isset($_SESSION['user_role']) == 'ROLE_ADMIN') {
            return true;
        }
    }

    public static function logged() {
        if(isset($_SESSION['user_id'])) {
            return true;
        }
    }

    public static function loggedAdmin() {
        if(isset($_SESSION['user_id']) and isset($_SESSION['user_role']) == 'ROLE_ADMIN') {
            return true;
        }
    }

}