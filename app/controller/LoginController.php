<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 09/03/2017
 * Time: 00:12
 */

namespace App\Controller;
use Core\Controller\Controller;
use Core\HTML\TemplateForm;
use App\Model\UserRepository;

class LoginController extends Controller
{
    public function login() {

        $this->template = 'default';
        
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
        
        $form = new TemplateForm($_POST);

        $this->render('login', compact('form', 'user'));
    }
}