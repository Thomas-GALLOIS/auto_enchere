<?php

/**
 * index.php - Point d'entrée de l'application
 * Ce fichier défini les routes et les méthodes des controleurs qui dervont être appelées
 */

/* Imports */
require_once __DIR__ . "/core/Router.class.php"; // Routeur
include_once __DIR__ . "/controllers/HomeController.php"; // Controleur Home
include_once __DIR__ . "/controllers/NotFoundController.php"; // Controlleur NotFound
include_once __DIR__ . "/controllers/CreateAnnonceController.php";
include_once __DIR__ . "/controllers/AccueilController.php";
include_once __DIR__ . "/controllers/AnnonceController.php";
include_once __DIR__ . "/controllers/LoginController.php";
include_once __DIR__ . "/controllers/EnchereController.php";
include_once __DIR__ . "/controllers/DeconnexionController.php";
include_once __DIR__ . "/controllers/ListeEnchereController.php";
include_once __DIR__ . "/controllers/MaxEnchereController.php";






/*********************/
/*      Requête      */
/*********************/
$method = $_SERVER['REQUEST_METHOD']; // Récupération du verbe
$uri = $_GET['uri']; // Récuépération de l'URI



/*********************/
/*       Router      */
/*********************/

/* Création du routeur */
$router = new Router($uri, $method);



/*********************/
/*       Routes      */
/*********************/

/*** Page d'accueil ***/
$homeController = new HomeController();
$createannonceController = new CreateAnnonceController();
$accueilController = new AccueilController();
$annonceController = new AnnonceController();
$loginController = new LoginController();
$enchereController = new EnchereController();
$DeconnexionController = new DeconnexionController();
$listeEnchereController = new ListeEnchereController();
$maxEnchereController = new MaxEnchereController();


$router->get("/form",  [$homeController, 'inscription_view']); // GET /
$router->post("/form", [$homeController, 'process_contact_form']); // POST /

/*********************/
$router->get("/mentions-legales",  [$homeController, 'mentions_legales']); // GET /
$router->get("/",  [$accueilController, 'render']);

$router->get("/test",  [$listeEnchereController, 'render']);

$router->get("/maxenchere",  [$maxEnchereController, 'render']);


$router->get("/",  [$loginController, 'render']); // GET /
$router->post("/",  [$loginController, 'connexion']); 

$router->get("/deconnexion",  [$DeconnexionController, 'render']); // GET /
$router->post("/deconnexion",  [$DeconnexionController, 'deconnexion']); 


$router->get("/annonce",  [$annonceController, 'render']); // GET /
// $router->post("/annonce",  [$annonceController, 'process_enchere']); 

$router->get("/create", [$createannonceController, 'render']);
$router->post("/create", [$createannonceController, 'process_create_form']);

$router->get("/annonce", [$enchereController, 'render']);
$router->post("/annonce", [$enchereController, 'process_enchere']);


/*** Route par défaut ***/
$router->default([new NotFoundController(), 'render']);
/*********************/



/***************************************/
/* Recherche de routes correspondantes */
/***************************************/

/* Démarrage du routeur */
$router->start();


