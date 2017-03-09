<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 09/03/2017
 * Time: 00:11
 */

namespace App\Controller;

use App\Model\UserRepository;
use Core\HTML\TemplateForm;
use Core\Controller\Controller;

class RegisterController extends Controller
{
    public function register() {
        $this->template = 'default';
        $userrepo = new UserRepository();
        $error = ' ';

        if(!empty($_POST)) {
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $password = $_POST['password'];
            $password_verif = $_POST['password_verif'];
            $error = $userrepo->register($email, $password, $password_verif, $nom, $prenom);
        }

        $form = new TemplateForm($_POST);
        $this->render('register', compact('form', 'error'));
    }

}