<?php

declare(strict_types=1);

class User
{
    private $_id;
    private $_nomUtilisateur;
    private $_email;
    private $_role;
    private $_dateCreation;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            //creation des setters
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //getters

    public function getId()
    {
        return $this->_id;
    }

    public function getNomeUtilisateur()
    {
        return $this->_nomUtilisateur;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getRole()
    {
        return $this->_role;
    }

    public function getDateCreation()
    {
        return $this->_dateCreation;
    }
}
