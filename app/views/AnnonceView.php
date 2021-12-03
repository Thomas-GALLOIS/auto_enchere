<?php

/**
 * views/Home.php - Vue Home
 * Cette vue permet d'afficher la page d'accueil.
 */


include_once __DIR__ . "/../views/AbstractView.php";
include_once __DIR__ . "/../views/NavbarView.php";
include_once __DIR__ . "/../views/ListeEnchereView.php";
include_once __DIR__ . "/../views/EnchereView.php";


/**
 * Vue Home
 */
class AnnonceView extends AbstractView
{

    protected $annonces;

    public function __construct($annonces)
    {
        $this->annonces = $annonces;
    }

    /**
     * Affichage de la page
     */
    public function render()
    { ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title>Boilerplate MVC PHP</title>

            <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
        </head>

        <body>
            <?php
            $navbar = new NavbarView();
            $navbar->render();
            ?>
            <div class="container">
                <div id="mainContainer">

                    <?php foreach ($this->annonces as $annonces) { ?>
                        <div class="annonce-container">
                            <h2><?= $annonces->title ?></h2>

                            <div class="bloc-annonce">
                                <div class="photo-annonce">
                                    <img src="./assets/src/voiture.jpeg" width="70%">
                                </div>
                                <div class="bloc-details-annonce">
                                    <div class="details-annonce">
                                        <p>
                                            <i>Publié par <?= $annonces->nom ?> <?= $annonces->prenom ?></i><br><br>
                                            Marque: <?= $annonces->marque ?></b><br />
                                            Modele: <?= $annonces->modele ?></h4><br />
                                            Puissance: <?= $annonces->puissance ?>CH<br />
                                            Mise en circulation: <?= $annonces->annee ?><br /><br />

                                            Details supplémentaires:<br />
                                            <?= $annonces->description ?><br /><br />
                                        </p>
                                    </div>
                                    <div class="prix">
                                        Mise à prix<br />
                                        <span class="prix-depart"><?= $annonces->prix_depart ?>€</span>
                                    </div>
                                </div>

                            </div>

                        </div>


                    <?php } ?>



                </div>

                <div class="list-encheres">

                    <?php
                    $dbh = Database::createDBConnection();

                    $inputEnchere = new EnchereView();
                    $inputEnchere->render();

                    $enchere = ListeEnchereModel::fetchByidAnnonce($dbh, $_GET["id"]);
                    $encheres = new ListeEnchereView($enchere);
                    $encheres->render();

                    ?>

                </div>
            </div>
        </body>
        <?php
        $footer_view = new FooterView();
        $footer_view->render();
        ?>

        </html>

<?php
    }
}
