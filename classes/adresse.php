<?php

/**
 *
 * <p>Permet la gestion d'une adresse</p>
 *
 * @name Adresse
 * @author Radern <radern@radern.com>
 * @link
 * @copyright Radern (2016)
 * @version 1.0.0
 */
class Adresse
{

    /* ~*~*~*~*~*~*~*~*~*~ */
    /* 1. proprietes */
    /* ~*~*~*~*~*~*~*~*~*~ */
    
    /**
     * Identifiant unique pour adresse
     *
     * @var (Integer)
     */
    private $id_adresse;

    /**
     * Identifiant unique pour personne
     *
     * @var (Integer)
     */
    private $id_personne;

    /**
     * Rue1
     *
     * @var (string)
     */
    private $rue1;

    /**
     * Rue2
     *
     * @var (string)
     */
    private $rue2;

    /**
     * code postal
     *
     * @var (string)
     */
    private $codepostal;

    /**
     * ville
     *
     * @var (string)
     */
    private $ville;

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
        $this->id_adresse = $valeur;
    }

    /**
     * Obtenir le id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id_adresse;
    }

    /**
     * Affectation du id
     *
     * @param
     *            integer id
     */
    public function setPersonne($valeur)
    {
        $this->id_personne = $valeur;
    }

    /**
     * Obtenir le id
     *
     * @return integer
     */
    public function getPersonne()
    {
        return $this->id_personne;
    }

    /**
     * Affectation du rue1
     *
     * @param
     *            string rue1
     */
    public function setRue1($valeur)
    {
        $this->rue1 = $valeur;
    }

    /**
     * Obtenir la rue1
     *
     * @return string
     */
    public function getRue1()
    {
        return $this->rue1;
    }

    /**
     * Affectation du rue2
     *
     * @param
     *            string rue2
     */
    public function setRue2($valeur)
    {
        $this->rue2 = $valeur;
    }

    /**
     * Obtenir la rue2
     *
     * @return string
     */
    public function getRue2()
    {
        return $this->rue2;
    }

    /**
     * Affectation du code postal
     *
     * @param
     *            string code postal
     */
    public function setCodePostal($valeur)
    {
        $this->codepostal = $valeur;
    }

    /**
     * Obtenir le code postal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codepostal;
    }

    /**
     * Affectation du code postal
     *
     * @param
     *            string code postal
     */
    public function setVille($valeur)
    {
        $this->ville = $valeur;
    }

    /**
     * Obtenir la ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
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
     *            string
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
     * Affectation de date mise à jour
     *
     * @param
     *            string
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
     *            integer numero de personne (0 pour vide)
     * @param
     *            integer personne
     * @param
     *            string rue1
     * @param
     *            string rue2
     * @param
     *            string code postal
     * @param
     *            string ville
     * @param
     *            date Date de création
     * @param
     *            date date de mise à jour
     *            
     * @return void
     */
    public function __construct($data_id, $data_personne, $data_rue1 = NULL, $data_rue2 = NULL, $data_ville = NULL, $data_codepostal = NULL, $dateCreation = NULL, $dateMaj = NULL)
    {
        $this->setId(0);
        if ($data_id == 0) {
            $this->setPersonne($data_personne);
            if (is_null($data_rue1)) {
                $this->getAdressePersonne($data_personne);
            } else {
                $this->setId($data_id);
                $this->setPersonne($data_personne);
                $this->setRue1($data_rue1);
                $this->setRue2($data_rue2);
                $this->setCodePostal($data_codepostal);
                $this->setVille($data_ville);
                $this->datecreation = $dateCreation;
                $this->datemaj = $dateMaj;
            }
        } else {
            $result = requete("SELECT id_adresse,id_personne,rue1,rue2,codepostal,ville,datecreation,datemaj FROM adresse WHERE id_adresse= '$data_id' LIMIT 1");
            if ($row = mysqli_fetch_object($result)) {
                $this->setId($row->id_adresse);
                $this->setPersonne($row->id_personne);
                $this->setRue1($row->rue1);
                $this->setRue2($row->rue2);
                $this->setCodePostal($row->codepostal);
                $this->setVille($row->ville);
                $this->datecreation = $row->datecreation;
                $this->datemaj = $row->datemaj;
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
     * Creation d'une nouvelle adresse
     *
     * @param integer id de la personne
     * @return integer retourne 1 si ok, sinon 0
     */
    public function createAdresse($data_personne)
    {
        if ($this->getId() == 0) {
            $this->setPersonne($data_personne);
            $rue1 = $this->getRue1();
            $rue2 = $this->getRue2();
            $ville = $this->getVille();
            $codepostal = $this->getCodePostal();
            $result = requete0("INSERT INTO adresse(id_personne,rue1,rue2,codepostal,ville,datemaj) VALUES('$data_personne','$rue1','$rue2','$codepostal','$ville',Now())");
            if ($result != 1) {
                $result = 0;
                afficheErreur("Création Adresse pas Ok");
            }
            return $result;
        }
    }

    /**
     * Mise à jour d'une adresse
     * <p>Directement en base de donn�e</p>
     */
    public function modifyAdresse()
    {
        $id = $this->getId();
        $personne = $this->getPersonne();
        $rue1 = $this->getRue1();
        $rue2 = $this->getRue2();
        $ville = $this->getVille();
        $codepostal = $this->getCodePostal();
        $result = requete0("UPDATE adresse SET id_personne='$personne',rue1='$rue1',rue2='$rue2',codepostal='$codepostal',ville='$ville',datemaj=Now() WHERE id_adresse='$id'");
    }

    /**
     * Supprimer une adresse
     * <p>Directement en base de donnée</p>
     *
     * @param
     *            integer id adresse à supprimer
     */
    public function deleteAdresse()
    {
        $id = $this->getId();
        $result = requete0("DELETE FROM adresse WHERE id_adresse='$id'");
    }

    /**
     * Setter une adresse
     *
     * @param
     *            string rue 1
     * @param
     *            string rue 2
     * @param
     *            string code postal
     * @param
     *            string ville
     *            
     */
    public function setAdressePersonne($data_rue1, $data_rue2, $data_codepostal, $data_ville)
    {
        $this->setRue1($data_rue1);
        $this->setRue2($data_rue2);
        $this->setCodePostal($data_codepostal);
        $this->setVille($data_ville);
    }

    /**
     * liste completes de toutes les adresses
     *
     * @param
     *            integer Premiere personne à prendre en compte pour la pagination
     * @param
     *            integer Nombre de personnes à prendre
     * @param
     *            string Inhibiteur de sécurité
     *            
     */
    public function getAdressePersonne($id_personne)
    {
        $result = requete("SELECT id_adresse,id_personne,rue1,rue2,codepostal,ville,datecreation,datemaj FROM adresse WHERE id_personne= '$id_personne' LIMIT 1");
        if ($row = mysqli_fetch_object($result)) {
            $this->__construct($row->id_adresse, $row->id_personne, $row->rue1, $row->rue2, $row->ville, $row->codepostal, $row->datecreation, $row->datemaj);
        }
        if (is_resource($result)) {
            mysqli_free_result($result);
        }
    }
}
