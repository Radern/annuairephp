<?php

/**
 * gestion téléphone
 *
 * <p>Permet la gestion du telephone</p>
 *
 * @name Adresse
 * @author Radern <radern@radern.com>
 * @link
 * @copyright Radern (2016)
 * @version 1.0.0
 */
class Telephone
{

    /* ~*~*~*~*~*~*~*~*~*~ */
    /* 1. proprietes */
    /* ~*~*~*~*~*~*~*~*~*~ */
    
    /**
     * Identifiant unique pour téléphone
     * 
     * @var (Integer)
     */
    private $id_telephone;

    /**
     * Identifiant unique pour personne
     * 
     * @var (Integer)
     */
    private $id_personne;

    /**
     * numero
     * 
     * @var (string)
     */
    private $numero;

    /**
     * type du numero
     * 
     * @var (string)
     */
    private $typenumero;

    /**
     * date de la création
     * 
     * @var (string)
     */
    private $datecreation;

    /**
     * date de la mise a jour
     * 
     * @var (string)
     */
    private $datemaj;

    /* ~*~*~*~*~*~*~*~*~*~*~*~*~ */
    /* 2.1 methodes accès privees */
    /* ~*~*~*~*~*~*~*~*~*~*~*~*~ */
    
    /**
     * Affectation du id
     *
     * @param
     *            integer id
     */
    public function setId($valeur)
    {
        $this->id_telephone = $valeur;
    }

    /**
     * Obtenir le id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id_telephone;
    }

    /**
     * Affectation du id personne
     *
     * @param
     *            integer id
     */
    public function setPersonne($valeur)
    {
        $this->id_personne = $valeur;
    }

    /**
     * Obtenir le id personne
     *
     * @return integer
     */
    public function getPersonne()
    {
        return $this->id_personne;
    }

    /**
     * Affectation du numero
     *
     * @param
     *            string numero
     */
    public function setNumero($valeur)
    {
        $this->numero = $valeur;
    }

    /**
     * Obtenir le type de numéro
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Affectation du type de numéro
     *
     * @param
     *            string type de numéro
     */
    public function setTypeNumero($valeur)
    {
        $this->typenumero = $valeur;
    }

    /**
     * Obtenir le type de téléphone
     *
     * @return string
     */
    public function getTypeNumero()
    {
        return $this->typenumero;
    }

    /**
     * Obtenir la date de création
     *
     * @return string
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Affectation la date de création
     *
     * @param
     *            string la date de création
     */
    public function setDatecreation($valeur)
    {
        $this->datecreation = $valeur;
    }

    /**
     * Obtenir la date de mise à jour
     *
     * @return string
     */
    public function getDatemaj()
    {
        return $this->datemaj;
    }

    /**
     * Affectation la date de mise a jour
     *
     * @param
     *            string la date de mise à jour
     */
    public function setDatemaj($valeur)
    {
        $this->datemaj = $valeur;
    }

    /* ~*~*~*~*~*~*~*~*~*~ */
    /* 2. methodes */
    /* ~*~*~*~*~*~*~*~*~*~ */
    
    /**
     * Constructeur
     *
     * <p>création de l'instance de la classe</p>
     *
     * @name Nom de la classe::__construct()
     * @param
     *            integer id Téléĥpne (0 pour vide)
     * @param
     *            integer id de la personne
     * @param
     *            string numéro de téléphone
     * @param
     *            string type de numéro
     * @param
     *            date Date de création
     * @param
     *            date date de mise à jour
     * @return void
     */
    public function __construct($data_id, $data_personne, $data_numero = NULL, $data_typenumero = NULL, $dateCreation = NULL, $dateMaj = NULL)
    {
        $this->setId(0);
        if ($data_id == 0) {
            $this->setPersonne($data_personne);
            if (is_null($data_numero)) {
                $this->getTelephonePersonne($data_personne);
            } else {
                $this->setNumero($data_numero);
                $this->setTypeNumero($data_typenumero);
                $this->setDatecreation($row->datecreation);
                $this->setDatemaj($row->datemaj);
            }
        } else {
            $result = requete("SELECT id_telephone,id_personne,numero,typenumero,datecreation,datemaj FROM telephone WHERE id_telephone= '$data_id' LIMIT 1");
            if ($row = mysqli_fetch_object($result)) {
                $this->setId($row->id_telephone);
                $this->setPersonne($row->id_personne);
                $this->setNumero($row->numero);
                $this->setTypeNumero($row->typenumero);
                $this->setDatecreation($row->datecreation);
                $this->setDatemaj($row->datemaj);
            }
            if (is_resource($result)) {
                mysqli_free_result($result);
            }
        }
    }

    /**
     * Destructeur
     *
     * <p>Destruction de l'instance de classe</p>
     *
     * @name Nom de la classe::__destruct()
     * @param
     *            nom du premier parametre
     * @param
     *            nom du second parametre
     * @param
     *            etc ...
     * @return void
     */
    public function __destruct()
    {}

    /* ~*~*~*~*~*~*~*~*~*~*~*~*~ */
    /* 2.1 methodes publiques */
    /* ~*~*~*~*~*~*~*~*~*~*~*~*~ */
    
    /*
     * Creation d'un téléphone
     *
     * @param integer id de la personne
     * @return integer retourne 1 si ok, sinon 0
     */
    public function createTelephone($data_personne)
    {
        if ($this->getId() == 0) {
            $this->setPersonne($data_personne);
            $numero = $this->getNumero();
            $typenumero = $this->getTypeNumero();
            $result = requete0("INSERT INTO telephone(id_personne,numero,typenumero,datemaj) VALUES('$data_personne','$numero','$typenumero',Now())");
            if ($result != 1) {
                $result = 0;
                afficheErreur("Création Personne pas Ok");
            }
            return $result;
        }
    }

    /**
     * Mise à jour d'un téléphone
     * <p>Directement en base de donn�e</p>
     */
    public function modifyTelephone()
    {
        $id = $this->getId();
        $numero = $this->getNumero();
        $typenumero = $this->getTypeNumero();
        $result = requete0("UPDATE telephone SET numero='$numero',typenumero='$typenumero',datemaj=Now() WHERE id_telephone='$id'");
    }

    /**
     * Supprimer un téléphone
     * <p>Directement en base de donn�e</p>
     * 
     * @param
     *            integer id
     */
    public function deleteTelephone()
    {
        $id = $this->getId();
        $result = requete0("DELETE FROM telephone WHERE id_telephone='$id'");
    }

    /**
     * Setter un numero
     *
     * @param
     *            string numéro
     * @param
     *            string type de numéro
     *            
     */
    public function setTelephonePersonne($numero, $typenumero)
    {
        $this->setNumero($numero);
        $this->setTypeNumero($typenumero);
    }

    /**
     * liste completes de toutes les personnes
     *
     * @param
     *            integer Premiere personne à prendre en compte pour la pagination
     * @param
     *            integer Nombre de personnes à prendre
     * @param
     *            string Inhibiteur de sécurité
     *            
     */
    public function getTelephonePersonne($id_personne)
    {
        $result = requete("SELECT id_telephone,id_personne,numero,typenumero,datecreation,datemaj FROM telephone WHERE id_personne= '$id_personne' LIMIT 1");
        if ($row = mysqli_fetch_object($result)) {
            $this->__construct($row->id_telephone, $row->id_personne, $row->numero, $row->typenumero, $row->datecreation, $row->datemaj);
        } else {
            $this->setId(0);
        }
        if (is_resource($result)) {
            mysqli_free_result($result);
        }
    }
}
