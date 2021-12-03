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
class EnchereModel
{

    /* Propriétés */
    protected $id;
    protected $id_utilisateurs;
    protected $id_annonces;
    protected $mise;
    protected $date;
    protected $dbh;


    /**
     * Constructeur
     */
    public function __construct($id, $id_utilisateurs, $id_annonces, $mise, $date, $dbh)
    {
        /* Nettoyage des données */
        $this->id = $id;
        $this->id_utilisateurs = $id_utilisateurs;
        $this->id_annonces = $id_annonces;
        $this->mise = filter_var($mise, FILTER_SANITIZE_NUMBER_FLOAT);
        $this->date = filter_var($date, FILTER_SANITIZE_STRING);
        $this->dbh = $dbh;
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


    /**
     * Insertion dans la base de données
     */
    public function insert()
    {

        $query = $this->dbh->prepare("INSERT INTO enchere (id_annonces,id_utilisateurs,mise,date) VALUES (?,?,?,?)");
        return $query->execute([$this->id_annonces, $this->id_utilisateurs, $this->mise, $this->date]);
    }


    /**
     * Récupération de contact par email
     */
    public static function fetchEncherebyID($dbh, $id)
    {

        $query = $dbh->prepare("SELECT * FROM enchere WHERE id_annonces=" . $id);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);


        $encheres = [];
        foreach ($results as $result) {
            array_push($encheres, new EnchereModel(
                $result['id'],
                $result['id_utilisateurs'],
                $result['id_annonces'],
                $result['mise'],
                $dbh
            ));
        }

        return $encheres;
    }
}
