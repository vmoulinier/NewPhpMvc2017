<?php

namespace App\Controller;

use Core\Controller\Controller;

class HomeController extends Controller
{
    public function index() {
        $this->template = 'default';
        $this->render('home/index');
    }
}