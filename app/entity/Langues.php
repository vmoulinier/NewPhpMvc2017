<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 13/03/2017
 * Time: 17:56
 */

namespace App\Entity;


class Langues
{

    private $id;

    private $name;

    /**
     * Langues constructor.
     */
    public function __construct()
    {
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}