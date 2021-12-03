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
class MaxEnchereModel
{

    /* Propriétés */
    protected $id;
    protected $id_annonces;
    protected $id_utilisateurs;
    protected $mise;
    protected $date;
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
        $id_annonces, 
        $id_utilisateurs, 
        $mise, 
        $date,
        $dbh,
        $nom,
        $prenom,
        $mail,
        $mdp)
    {
        /* Nettoyage des données */
        $this->id = $id;
        $this->id_annonces = $id_annonces;
        $this->id_utilisateurs = $id_utilisateurs;
        $this->mise = filter_var($mise, FILTER_SANITIZE_STRING);
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

    public static function getMaxEnchereByAnnonce($dbh, $annonce_id){
        $query = $dbh->prepare("SELECT MAX(mise) FROM enchere WHERE id_annonces =".$annonce_id);  // ou contact en singulier
        $query->execute([$annonce_id]);
        $results = $query->fetch();
        //var_dump($results);
        return intval($results["MAX(mise)"]);
    }

    public static function getWinnerByAnnonce($dbh, $max_enchere){

        $query = $dbh->prepare(
            "SELECT u.*, e.* FROM enchere e 
            INNER JOIN utilisateurs u ON u.id = e.id_utilisateurs
            WHERE e.mise=".$max_enchere);


        // $query = $dbh->prepare("SELECT * FROM enchere WHERE mise =".$max_enchere);  // ou contact en singulier
        $query->execute([$max_enchere]);
        $results = $query->fetch();
        //var_dump($results);
        return $results["prenom"];
    }
    // $max_enchere = getMaxEnchereByAnnonce($results["id"]); echo "La max enchere est : "; var_dump($max_enchere);

}
