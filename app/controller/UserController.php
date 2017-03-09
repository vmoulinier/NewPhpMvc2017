<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 09/03/2017
 * Time: 23:37
 */

namespace App\Controller;

use App\Model\UserRepository;
use Core\Controller\Controller;
use Core\HTML\TemplateForm;


class UserController extends Controller
{
    public function login() {
        $this->template = 'default';
        $error = ' ';
        $userrepo = new UserRepository();

        if(!empty($_POST)) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($userrepo->login($email, $password)) {
                header('Location: index.php?p=user/profil');
            }
            else {
                $error = 'Mauvais mail/mot de passe !';
            }
        }

        $form = new TemplateForm($_POST);

        $this->render('user/login', compact('form', 'user', 'error'));
    }

    public function register() {
        $this->template = 'default';
        $userrepo = new UserRepository();
        $error = ' ';

        if($userrepo->islogged()){
            $this->denied();
        }

        if(!empty($_POST)) {
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $password = $_POST['password'];
            $password_verif = $_POST['password_verif'];
            $error = $userrepo->register($email, $password, $password_verif, $nom, $prenom);
        }

        $form = new TemplateForm($_POST);
        $this->render('user/register', compact('form', 'error'));
    }

    public function logout() {
        session_destroy();
        unset($_SESSION['user_id']);
        header('Location: index.php?p=home/index');
    }

    public function profil() {
        $this->template = 'default';
        $userrepo = new UserRepository();
        if(!$userrepo->islogged()){
            $this->denied();
        }
        $this->render('user/profil', compact('user'));
    }
}