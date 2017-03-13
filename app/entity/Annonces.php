<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 12/03/2017
 * Time: 16:10
 */

namespace App\Entity;


use App\Model\Repository;
use App\Model\SPDO;

class Annonces
{

    private $id;

    private $date;

    private $content;

    private $title;
    
    private $user;

    /**
     * Annonces constructor.
     */
    public function __construct(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user_id
     */
    public function setUser($user_id)
    {
        $req = SPDO::getInstance()->prepare('SELECT * FROM user WHERE id = :id');
        $req->execute(array(':id' => $user_id));
        $res = $req->fetch();
        $repo = new Repository();
        $user = $repo->hydrate('user', $res);
        $this->user = $user;
    }
}