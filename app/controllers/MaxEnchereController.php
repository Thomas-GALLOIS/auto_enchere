<?php

/**
 * controllers/Home.php - Controleur Home
 * Ce controleur regroupe les méthodes de la page d'accueil.
 */

/* Namespace */

/* Imports */
include_once __DIR__ . "/../core/Database.class.php"; // Utilitaire de connexion à la base de données
include_once __DIR__ . "/../models/MaxEnchereModel.php"; // Modèle Contact
include_once __DIR__ . "/../views/MaxEnchereView.php"; // Vue Home

/* Alias */

/**
 * Controleur Home
 */
class maxEnchereController
{

    /**
     * Affichage de la page d'accueil
     */
    public function render()
    {
        $dbh = Database::createDBConnection();
        $maxEnchere = MaxEnchereModel::getMaxEnchereByAnnonce($dbh, $_GET["id"]) ;
        $maxEnchereWinner = MaxEnchereModel::getWinnerByAnnonce($dbh, $maxEnchere);
        $maxEnchere_view = new MaxEnchereView($maxEnchere,$maxEnchereWinner); // Création d'une instance
        $maxEnchere_view->render(); // Appel de la méthode de rendu (affichage)

    }

}


