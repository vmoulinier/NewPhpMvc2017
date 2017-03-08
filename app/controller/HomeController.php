<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Entity\User;
use Core\HTML\TemplateForm;
use App\Model\UserRepository;

class HomeController extends Controller
{
    public function home() {

        $userrepo = new UserRepository();

        if(!empty($_POST)) {
            var_dump($_POST);
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($userrepo->login($email, $password)) {
                header('Location: index.php?p=profil');
            }
            else {
                var_dump($userrepo->login($email, $password));
            }
        }
        $this->template = 'default';
        $user = new User('1');
        $form = new TemplateForm($_POST);
        $this->render('index', compact('form', 'user'));
    }
}