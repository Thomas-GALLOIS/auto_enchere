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
class MaxEnchereView extends AbstractView
{

    protected $result ;
    protected $winner;

    public function __construct($result,$winner)
    {
        $this->result = $result ;
        $this->winner = $winner ;
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

                        <div class="max-enchere">
                            <center>
                                <h3>Enchere la plus élevée:</h1>
                                <?php echo $this->result;?>€<br>
                                    par: <?php echo $this->winner;?>

                                <br><br><br>
                            </center>
                        </div>
    </body>
    </html>             


<?php
    }
}



