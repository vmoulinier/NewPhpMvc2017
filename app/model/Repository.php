<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 13/03/2017
 * Time: 18:00
 */

namespace App\Model;


class Repository
{
    public static function getCurrentUser() {
        $id = $_SESSION['user_id'];
        if($id) {
            $req = SPDO::getInstance()->prepare('SELECT * FROM user WHERE id = "' . $id . '"');
            $req->execute();
            $res = $req->fetch();
            $repo = new Repository();
            $user = $repo->hydrate('user', $res);
            return $user;
        } else {
            return false;
        }
    }

    public function findById($nomtable, $id) {
        $req = SPDO::getInstance()->prepare('SELECT * FROM '.$nomtable.' WHERE id = "'.$id.'"');
        $req->execute();
        $res = $req->fetch(\PDO::FETCH_OBJ);
        if($res) {
            return $res;
        }
        else {
            return false;
        }
    }

    public function hydrate($strobject, array $data) {
        $strobject =  '\App\Entity\\'.ucfirst($strobject);
        if(class_exists($strobject)){
            $object = new $strobject();
            foreach ($data as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($object, $method)) {
                    $object->$method($value);
                }
            }
            return $object;
        }
        return false;
    }

    public function test($nomtable, $id){
        $req = SPDO::getInstance()->prepare('SELECT * FROM '.$nomtable.' WHERE id = "'.$id.'"');
        $req->execute();
        $res = $req->fetch(\PDO::FETCH_OBJ);
        if($res) {
            $strobject =  '\App\Entity\\'.ucfirst($nomtable);
            $object = new $strobject();
            foreach ($res as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($object, $method)) {
                    $object->$method($value);
                }
            }
            return $object;
        }

        return false;

    }

    public function findBy($nomtable, $param, $value) {
        $req = SPDO::getInstance()->prepare('SELECT * FROM '.$nomtable.' WHERE '.$param.' = "'.$value.'"');
        $req->execute();
        $res = $req->fetchAll(\PDO::FETCH_OBJ);
        if($res) {
            return $res;
        }
        else {
            return false;
        }
    }

    public function findAll($nomtable) {
        $req = SPDO::getInstance()->prepare('SELECT * FROM '.$nomtable);
        $req->execute();
        $res = $req->fetchAll(\PDO::FETCH_OBJ);
        if($res) {
            return $res;
        }
        else {
            return false;
        }
    }
}