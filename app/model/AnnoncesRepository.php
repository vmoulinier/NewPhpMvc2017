<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 12/03/2017
 * Time: 16:14
 */

namespace App\Model;


use App\Entity\Annonces;

class AnnoncesRepository
{
    public function getAllAnnonces() {
        $req = SPDO::getInstance()->query('SELECT * FROM annonces');
        $datas = $req->fetchAll();
        $array = array();
        foreach ($datas as $key => $data) {
            $annonce = new Annonces($data);
            $annonce->setUser($data['user_id']);
            $array[$key] = $annonce;
        }
        return $array;
    }

    public function getAnnonce($id) {
        $req = SPDO::getInstance()->query('SELECT * FROM annonces WHERE id = "'.$id.'"');
        $data = $req->fetch();
        if($data) {
            $annonce = new Annonces($data);
            $annonce->setUser($data['user_id']);
            return $annonce;
        } else {
            return false;
        }
    }

    public function addAnnonce($title, $content, $user_id) {
        $req = SPDO::getInstance()->prepare('INSERT INTO annonces (title, content, user_id) VALUES (:title, :content, :user_id)');
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':user_id', $user_id);
        $req->execute();
        return true;
    }
}