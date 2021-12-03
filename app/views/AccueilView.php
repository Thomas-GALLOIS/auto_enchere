<?php

/**
 * views/Home.php - Vue Home
 * Cette vue permet d'afficher la page d'accueil.
 */


include_once __DIR__ . "/../views/AbstractView.php"; 
include_once __DIR__ . "/../views/NavbarView.php"; 

/**
 * Vue Home
 */
class AccueilView extends AbstractView
{

    protected $annonces ;

    public function __construct($annonces)
    {
        $this->annonces = $annonces ;
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
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">            <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
        </head>

        <body>
            <?php 
                $navbar = new NavbarView();
                $navbar->render();
            ?>

            <div id="mainContainer">


                <?php
                foreach ($this->annonces as $annonces) { ?>
                    <div class="annonce">
                        <a href="<?= $this->base_url() ?>annonce?id=<?=$annonces->id?>">
                        <img src="./assets/src/voiture.jpeg" width="300px">
                            <h2><?= $annonces->marque ?></h2>
                            <h4><?= $annonces->modele?></h3>
                            <p>Mise à prix</p>
                            <h2><?= $annonces->prix_depart ?>€</h2>
                            </p>
                        </a>
                    </div>
                <?php } ?>
                

            </div>
        </body>
        <?php
    $footer_view = new FooterView() ;
    $footer_view->render() ;
?>
        </html>

<?php
    }
}
