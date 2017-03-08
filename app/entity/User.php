<?php

namespace App\Entity;

use App\Model\SPDO;

class User
{
    private $id;

    private $nom;
    
    private $prenom;

    private $adresse;

    private $password;

    private $email;

    /**
     * User constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $stmt = SPDO::getInstance()->query('SELECT * FROM user WHERE id = '. $id);
        $res = $stmt->fetch(\PDO::FETCH_OBJ);
        if($res == true) {
            $this->id = $res->id;
            $this->nom = $res->nom;
            $this->prenom = $res->prenom;
            $this->email = $res->email;
            $this->adresse = $res->id_adresse;
            $this->password = $res->password;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        $stmt = SPDO::getInstance()->query('SELECT * FROM adresse WHERE id = ' .$this->adresse );
        $res = $stmt->fetch(\PDO::FETCH_OBJ);
        if($res) {
            $adresse = new Adresse();
            $adresse->setVille($res->ville);
            $adresse->setCp($res->cp);
            return $adresse;
        }

        return false;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
}