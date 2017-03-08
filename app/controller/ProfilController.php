<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Entity\User;

class ProfilController extends Controller
{
    public function profil() {
        $this->template = 'default';
        $user = new User('1');
        $this->render('profil', compact('user'));
    }
}