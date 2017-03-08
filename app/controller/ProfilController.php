<?php

namespace App\Controller;

use App\Model\UserRepository;
use Core\Controller\Controller;

class ProfilController extends Controller
{
    public function profil() {
        $this->template = 'default';
        $userrepo = new UserRepository();
        if(!$userrepo->islogged()){
            $this->denied();
        }
        $this->render('profil', compact('user'));
    }
}