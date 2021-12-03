<?php

/**
 * controllers/Home.php - Controleur Home
 * Ce controleur regroupe les méthodes de la page d'accueil.
 */

/* Namespace */

/* Imports */
include_once __DIR__ . "/../core/Database.class.php"; // Utilitaire de connexion à la base de données
include_once __DIR__ . "/../models/LoginModel.php"; // Modèle Contact
include_once __DIR__ . "/../views/NavbarView.php"; // Vue Home
include_once __DIR__ . "/../views/AbstractView.php";
// include_once __DIR__ . "/../views/NavbarView.php"; // Vue Home


/* Alias */

/**
 * Controleur Home
 */
class DeconnexionController extends AbstractView
{

    function render(){
        $deconnexion_view = new DeconnexionView();
        $deconnexion_view->render();

        
    }

    function deconnexion() {
        session_start();
        unset($_SESSION);
        session_destroy();
        session_write_close();
        header('Location: '.$this->base_url()); // Si tout est bon il a redirigé vers la page annonces/home
            
    }

}
