<?php

namespace Core\Controller;

class Controller{

    protected $path;
    protected $template;

    /**
     * Controller constructor.
     */
    public function __construct(){
        $this->path = 'app/views/';
    }


    protected function render($view, $datas = []){
        ob_start();
        extract($datas);
        require($this->path . 'home/' . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->path . 'templates/' . $this->template . '.php');
    }

    protected function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    protected function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

}