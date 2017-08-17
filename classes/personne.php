<?php
include_once "telephone.php";
include_once "adresse.php";

/**
 * gestion personne
 *
 * <p>Permet la gestion d'une personne</p>
 *
 * @name Personne
 * @author Radern <radern@radern.com>
 * @link
 * @copyright Radern (2016)
 * @version 1.0.0
 * @package Personne
 */
class Personne
{

    /* ~*~*~*~*~*~*~*~*~*~ */
    /* 1. proprietes */
    /* ~*~*~*~*~*~*~*~*~*~ */
    
    /**
     * Identifiant unique pour personne
     *
     * @var (Integer)
     */
    private $id;

    /**
     * Nom
     *
     * @var (string)
     */
    private $nom;

    /**
     * Prenom de la personne
     *
     * @var (string)
     */
    private $prenom;

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

    /**
     * téléphone de la personne
     *
     * @var (Telephone)
     */
    private $telephone;

    /**
     * adresse de la personne
     *
     * @var (Adresse)
     */
    private $adresse;

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
        $this->id = $valeur;
    }

    /**
     * Obtenir le id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Affectation du nom
     *
     * @param
     *            string nom
     */
    public function setNom($valeur)
    {
        $this->nom = $valeur;
    }

    /**
     * Obtenir le nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Affectation du prénom
     *
     * @param
     *            string prénom
     */
    public function setPrenom($valeur)
    {
        $this->prenom = $valeur;
    }

    /**
     * Obtenir le prénom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
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
     * Obtenir le date de mise à jour
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

    /**
     * Obtenir le telephone
     *
     * @return Telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Obtenir adresse
     *
     * @return Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
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
     *            string nom
     * @param
     *            string prenom
     * @param
     *            date Date de création
     * @param
     *            date date de mise à jour
     * @return void
     */
    public function __construct($data_id, $data_nom, $data_prenom, $dateCreation = NULL, $dateMaj = NULL)
    {
        $this->setId(0);
        if ($data_id == 0 or ! empty($data_nom)) {
            $this->setId($data_id);
            $this->setNom($data_nom);
            $this->setPrenom($data_prenom);
            $this->setDatecreation($dateCreation);
            $this->setDatemaj($dateMaj);
            $this->telephone = new Telephone(0, $data_id, null, null);
            $this->adresse = new Adresse(0, $data_id);
        } else {
            $result = requete("SELECT id,nom,prenom,datecreation,datemaj FROM personne WHERE id= '$data_id' LIMIT 1");
            if ($row = mysqli_fetch_object($result)) {
                $this->setId($row->id);
                $this->setNom($row->nom);
                $this->setPrenom($row->prenom);
                $this->setDatecreation($row->datecreation);
                $this->setDatemaj($row->datemaj);
                $this->telephone = new Telephone(0, $data_id, null, null);
                $this->adresse = new Adresse(0, $data_id);
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
     * Creation d'une nouvelle personne
     *
     * @return integer retourne 1 si ok, sinon 0
     */
    public function createPersonne()
    {
        if ($this->getId() == 0) {
            $nom = $this->getNom();
            $prenom = $this->getPrenom();
            $result = requete0("INSERT INTO personne(nom,prenom,datemaj) VALUES('$nom','$prenom',Now())");
            if ($result == 1) {
                $result = 0;
                // Rechercher le nouvel id crée
                $this->chercherId($nom, $prenom);
                // Enregistrer le téléphone
                $telephone = $this->getTelephone();
                if ($telephone->createTelephone($this->getId())) {
                    // Enregistrer l'adresse
                    $adresse = $this->getAdresse();
                    if ($adresse->createAdresse($this->getId())) {
                        $result = 1;
                    }
                }
            } else {
                $result = 0;
                afficheErreur("Création Personne pas Ok");
            }
            return $result;
        }
    }

    /**
     * Mise à jour d'une personne
     * <p>Directement en base de donn�e</p>
     */
    public function modifyPersonne()
    {
        $id = $this->getId();
        $nom = $this->getNom();
        $prenom = $this->getPrenom();
        $result = requete0("UPDATE personne SET nom='$nom',prenom='$prenom',datemaj=Now() WHERE id='$id'");
        $this->getTelephone()->modifyTelephone();
        $this->getAdresse()->modifyAdresse();
    }

    /**
     * Supprimer une personne
     * <p>Directement en base de donn�e</p>
     *
     * @param
     *            integer id
     */
    public function deletePersonne()
    {
            $idd = $this->getId();
            $this->getAdresse()->deleteAdresse();
            $this->getTelephone()->deleteTelephone();
            $result = requete0("DELETE FROM personne WHERE id='$idd'");
    }

    /**
     * Chercher la personne
     *
     * @param
     *            string Nom
     * @param
     *            string Prénom
     *            
     */
    public function chercherId($nom, $prenom)
    {
        $recherche = " nom='$nom'";
        $recherche .= " AND prenom='$prenom' ORDER BY id DESC";
        $result = requete("SELECT id FROM personne WHERE $recherche");
        if ($row = mysqli_fetch_object($result)) {
            $retour = $row->id;
            $this->setId($row->id);
        }
        if (is_resource($result)) {
            mysqli_free_result($result);
        }
    }

    /**
     * Chercher la personne
     *
     * @param
     *            integer id
     * @param
     *            string Nom
     * @param
     *            string Prénom
     *            
     */
    public function chercher($id, $nom, $prenom)
    {
        $recherche = '1';
        if ($id > 0) {
            $recherche .= " AND id='$id'";
        }
        if (! empty($nom)) {
            $recherche .= " AND nom='$nom'";
        }
        if (! empty($prenom)) {
            $recherche .= " AND prenom='$prenom ORDER BY id DESC";
        }
        
        if ($recherche != '1') {
            $result = requete("SELECT id,nom,prenom,datecreation,datemaj FROM personne WHERE 1 $recherche");
            if ($row = mysqli_fetch_object($result)) {
                $this->__construct($row->id, $row->nom, $row->prenom, $row->datecreation, $row->datemaj);
            }
            if (is_resource($result)) {
                mysqli_free_result($result);
            }
        }
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
     * @return Array
     *
     */
    public function getListeALLPersonnes($Debut, $Nb_msg_page)
    {
        $result = requete("SELECT id,nom,prenom,datecreation,datemaj FROM personne WHERE id > 0 ORDER BY id DESC LIMIT $Debut,$Nb_msg_page");
        $home = Array();
        $nb_Enr = $result->num_rows;
        // $home->setNombre($nb_Enr);
        while ($row = mysqli_fetch_object($result)) {
            $actuel = new Personne($row->id, $row->nom, $row->prenom, $row->datecreation, $row->datemaj);
            $home[] = $actuel;
        }
        if (is_resource($result)) {
            mysqli_free_result($result);
        }
        return $home;
    }

    /**
     * Recomptage des personnes
     */
    public function comptage()
    {
        $result = requete("SELECT count(id) as nombre FROM personne");
        if ($row = mysqli_fetch_object($result)) {
            $nombre = $row->nombre;
        } else {
            $nombre = 0;
        }
        if (is_resource($result)) {
            mysqli_free_result($result);
        }
        return $nombre;
    }
}
