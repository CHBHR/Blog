<?php

declare(strict_types=1);

class Article
{

    private $_id;
    private $_titre;
    private $_chapo;
    private $_contenu;
    private $_date_creation;
    private $_date_mise_a_jour;
    private $_auteur_id;

    public function __construct($data){
        $this->hydrate($data);
    }
    
    public function hydrate(array $data){
        foreach ($data as $key => $value) {
            //creation des setters
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //setters

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0){
            $this->_id = $id;
        }
    }

    public function setTitre($titre)
    {
        if (is_string($titre)){
            $this->_titre = $titre;
        }
    }

    public function setChapo($chapo)
    {
        if (is_string($chapo)){
            $this->_chapo = $chapo;
        }
    }

    public function setContenu($contenu)
    {
        if (is_string($contenu)){
            $this->_contenu = $contenu;
        }
    }

    public function setDateCreation($dateCreation)
    {
        $this->_date_creation = $dateCreation;
    }

    public function setDateMAJ($dateMAJ)
    {
        $this->_date_mise_a_jour = $dateMAJ;
    }

    public function setAuteurId($auteurId)
    {
        $auteurId = (int) $auteurId;
        if ($auteurId > 0){
            $this->_auteurId = $auteurId;
        }
    }

    //getters

    public function getId()
    {
        return $this->_id;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

    public function getChapo()
    {
        return $this->_chapo;
    }

    public function getContenu()
    {
        return $this->_contenu;
    }

    public function getDateCreation()
    {
        return $this->_date_creation;
    }

    public function getDateMAJ()
    {
        return $this->_date_mise_a_jour;
    }

    public function getAuteurId()
    {
        return $this->_auteur_id;
    }

}