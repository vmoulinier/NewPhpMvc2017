<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Entity\User;
use Core\HTML\TemplateForm;

class HomeController extends Controller
{
    public function home() {
        if(!empty($_POST)) {
            var_dump($_POST);
        }
        $this->template = 'default';
        $user = new User('1');
        
        $form = new TemplateForm($_POST);
        $this->render('index', compact('form', 'user'));
    }
}