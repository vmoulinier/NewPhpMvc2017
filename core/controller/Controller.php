<?php

namespace Core\Controller;

use App\Model\Repository;

class Controller{

    protected $path;
    protected $template;
    protected $repository;

    /**
     * Controller constructor.
     */
    public function __construct(){
        $this->path = 'app/views/';
        $this->repository = new Repository();
    }


    protected function render($view, $datas = []){
        ob_start();
        extract($datas);
        require($this->path . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->path . 'templates/' . $this->template . '.php');
    }

    protected function denied(){
        $this->template = 'default';
        $this->render('error/404');
        die;
    }

}