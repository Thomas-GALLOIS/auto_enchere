<?php

/**
 * models/contact.php - Modèle Contact
 * Cette classe modélise une entrée de la table contact de la base de donnée.
 */


/* Alias */
//use PDO;


/**
 * Modèle Contact
 */
class AnnonceModel
{

    /* Propriétés */
    protected $id;
    protected $id_utilisateurs;
    protected $title;
    protected $modele;
    protected $marque;
    protected $date_fin;
    protected $description;
    protected $puissance;
    protected $annee;
    protected $prix_depart;
    protected $status;
    protected $dbh;
    protected $nom;
    protected $prenom;
    protected $mail;
    protected $mdp;


    /**
     * Constructeur
     */
    public function __construct(
        $id, 
        $id_utilisateurs, 
        $title, 
        $modele, 
        $marque, 
        $date_fin, 
        $description, 
        $puissance,
        $annee, 
        $prix_depart, 
        $status, 
        $dbh,
        $nom,
        $prenom,
        $mail,
        $mdp)
    {
        /* Nettoyage des données */
        $this->id = $id;
        $this->id_utilisateurs = $id_utilisateurs;
        $this->title = filter_var($title, FILTER_SANITIZE_STRING);
        $this->modele = filter_var($modele, FILTER_SANITIZE_STRING);
        $this->marque = filter_var($marque, FILTER_SANITIZE_STRING);
        $this->date_fin = filter_var($date_fin, FILTER_SANITIZE_STRING);
        $this->description = filter_var($description, FILTER_SANITIZE_STRING);
        $this->puissance = filter_var($puissance, FILTER_SANITIZE_STRING);
        $this->annee = filter_var($annee, FILTER_SANITIZE_STRING);
        $this->prix_depart = filter_var($prix_depart, FILTER_SANITIZE_STRING);
        $this->status = $status;
        $this->dbh = $dbh;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->mdp = $mdp;
    }

    /**
     * Get
     */
    public function __get($property)
    {
        if ($property !== "dbh") {
            return $this->$property;
        }
    }

    /**
     * Set
     */
    public function __set($property, $value)
    {
        if ($property !== "dbh") {
            $this->$property = $value;
        }
    }




    public static function fetchByidAnnonce($dbh){
        $query = $dbh->prepare("SELECT u.*, a.* FROM utilisateurs u INNER JOIN annonces a ON u.id = a.id_utilisateurs");
        $query->execute();
        $results = $query ->fetchAll(PDO::FETCH_ASSOC);

        $annonces = [];
        foreach ($results as $result) {
            array_push($annonces,new AnnonceModel(
                $result['id'],
                $result['id_utilisateurs'], 
                $result['title'], 
                $result['modele'], 
                $result['marque'],
                $result['date_fin'], 
                $result['description'], 
                $result['puissance'],
                $result['annee'],
                $result['prix_depart'],
                $result['status'],
                $dbh,
                $result['nom'],
                $result['prenom'],
                $result['mail'],
                $result['mdp']));
        }

        return $annonces;
    }

    static public function getAnnonceId($dbh, $id)
    {
        $dbh = database::createDBConnection();
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $query = $dbh->prepare(
            "SELECT u.*, a.*, e.* FROM annonces a 
            INNER JOIN utilisateurs u ON u.id = a.id_utilisateurs
            LEFT JOIN enchere e ON a.id = e.id_annonces
            WHERE a.id=".$_GET['id']);
        $query->execute();
        $result = $query ->fetch();

        // if(!$result) {
        //     return false;
        // }

        return new AnnonceModel(
            $result['id'],
            $result['id_utilisateurs'], 
            $result['title'], 
            $result['modele'], 
            $result['marque'],
            $result['date_fin'], 
            $result['description'], 
            $result['puissance'],
            $result['annee'],
            $result['prix_depart'],
            $result['status'],
            $dbh,
            $result['nom'],
            $result['prenom'],
            $result['mail'],
            $result['mdp']);
    }

}
