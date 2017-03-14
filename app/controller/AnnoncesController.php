<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 12/03/2017
 * Time: 21:24
 */

namespace App\Controller;


use App\Model\UserRepository;
use Core\Controller\Controller;
use App\Model\AnnoncesRepository;
use Core\HTML\TemplateForm;

class AnnoncesController extends Controller
{
    public function index() {
        $this->template = 'default';
        $annoncesrepo = new AnnoncesRepository();
        $annonces =  $annoncesrepo->getAllAnnonces();
        $this->render('annonces/index', compact('annonces'));
    }

    public function view_annonce() {
        $this->template = 'default';
        $annoncerepo = new AnnoncesRepository();
        if(isset($_GET['id'])) {
            $annonce = $annoncerepo->getAnnonce($_GET['id']);
            if ($annonce) {
                $this->render('annonces/view_annonce', compact('annonce'));
            } else {
                $this->render('error/404');
            }
        }   else {
            $this->render('error/404');
        }
    }
    
    public function create() {
        $this->template = 'default';

        $userrepo = new UserRepository();
        $repo = new AnnoncesRepository();
        $form = new TemplateForm($_POST);
        $user = $this->repository->getCurrentUser();
        
        if(!$userrepo->islogged()){
            $this->denied();
        }
        
        if(!empty($_POST)) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            if($repo->addAnnonce($title, $content, $user->getId())) {
                setcookie("error", 'Annonce enregistrée', time()+5);
                header('Location: '.PATH.'/annonces/create');
            } else {
                setcookie("error", 'Un problème est survenu', time()+5);
                header('Location: '.PATH.'/annonces/create');
            }
        }

        $this->render('annonces/create', compact('form', 'user', 'error'));
    }
}