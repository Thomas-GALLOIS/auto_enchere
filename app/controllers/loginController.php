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
include_once __DIR__ . "/../views/AbstractView.php"; // Vue Home

// include_once __DIR__ . "/../views/NavbarView.php"; // Vue Home


/* Alias */

/**
 * Controleur Home
 */
class LoginController extends AbstractView
{

    function render(){
        $login_view = new NavbarView($connecte);
        $login_view->render();

        
    }

    function connexion() {
        $dbh = Database::createDBConnection();
        $login = LoginModel::connexion($dbh,0,$_POST["email-login"],$_POST["password-login"]);

        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE mail = ?"); 
        $query->execute([$_POST["email-login"]]);
    
        $results = $query->fetchAll(); //var_dump($results); echo $results[0]["mdp"];


        $hash_verify = $results[0]["mdp"];
        $user_id = $results[0]["id"];
        
        //var_dump(password_verify($_POST["mdp"], $hash_verify)); // si le mdp correspond a son hash c'est true
        $connecte = (password_verify($_POST["password-login"], $hash_verify));
            
        if($connecte){
            $_SESSION = true;
            session_start();            
            $_SESSION["user_mail"]= $_POST["email-login"];
            $_SESSION["user_id"]= $user_id;
            // echo "<br>Bonjour <br>".$_SESSION["user_mail"]."<br>Vous etes connecté<br> ID = ".$_SESSION["user_id"];
    
            header('Location: '.$this->base_url()); // Si tout est bon il a redirigé vers la page annonces/home
    
            } else {
            echo "<br> Identifiants incorrects. Veuillez ressayer <br>";
            }
        
            
    }

    // function showLogin() {


    //     $dbh = Database::createDBConnection();
    //     $login = LoginModel::connexion($dbh,0,$_POST["email-login"],$_POST["password-login"]);

    //     $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE mail = ?"); 
    //     $query->execute([$_POST["email-login"]]);
    
    //     $results = $query->fetchAll(); //var_dump($results); echo $results[0]["mdp"];


    //     $hash_verify = $results[0]["mdp"];
    //     $user_id = $results[0]["id"];
        
    //     //var_dump(password_verify($_POST["mdp"], $hash_verify)); // si le mdp correspond a son hash c'est true
    //     $connecte = (password_verify($_POST["password-login"], $hash_verify));
            
    //     $showLogin_view = new LoginView($connecte);
    //     $showLogin_view->render();

    //     if($connecte){
    //         session_start();
    //         echo "coucou";
    //     } else {
    //         echo "oh non";
    //     }

    // }
}
