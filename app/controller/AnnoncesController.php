<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 12/03/2017
 * Time: 21:24
 */

namespace App\Controller;


use Core\Controller\Controller;
use App\Model\AnnoncesRepository;

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
}