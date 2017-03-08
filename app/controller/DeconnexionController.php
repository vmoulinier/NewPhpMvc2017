<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 09/03/2017
 * Time: 00:03
 */

namespace App\Controller;


class DeconnexionController
{
    public function deconnexion() {
        session_destroy();
        unset($_SESSION['user_id']);
        header('Location: index.php?p=home');
    }
}