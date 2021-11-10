<?php

/**
 * controllers/Home.php - Controleur Home
 * Ce controleur regroupe les méthodes de la page d'accueil.
 */

/* Namespace */

/* Imports */
include_once __DIR__ . "/../core/Database.class.php"; // Utilitaire de connexion à la base de données
include_once __DIR__ . "/../models/CreateAnnonceModel.php"; // Modèle Contact
include_once __DIR__ . "/../views/AccueilView.php"; // Vue Home

/* Alias */

/**
 * Controleur Home
 */
class AccueilController
{

    /**
     * Affichage de la page d'accueil
     */
    public function render()
    {
        $dbh = Database::createDBConnection();
        $annonces = CreateAnnonceModel::fetchAllAnnonces($dbh) ;
        $annonces_view = new AccueilView($annonces); // Création d'une instance
        $annonces_view->render(); // Appel de la méthode de rendu (affichage)
    }

}
