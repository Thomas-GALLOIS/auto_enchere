<?php





include_once __DIR__ . "/../views/AbstractView.php"; 
include_once __DIR__ . "/../views/FooterView.php"; 

class FormInscriptionView extends AbstractView
{

    protected $result; 

    public function __construct($result)
    {

        if (isset($result)) {
            $this->result = $result; 
        }
    }


 


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
            <div id="mainContainer">

                <div class="bloc-formulaire-inscription">

                    <div class="inscription">

                    <h1>CREATION DE COMPTE</h1>

                    <?php if (!isset($this->result)) { ?>
                        <p>
                            Pour créer un compte, veuillez remplir le formulaire ci-dessous et valider.
                        </p>
                    <?php } else if ($this->result === true) { ?>
                        <p>Votre compte a bien été enregistrée.</p>
                    <?php } else { ?>
                        <p>Une erreur s'est produite, veuillez réessayer.</p>
                    <?php } ?>
                    </div>
                    <div class="inscription-input">
                        <form  action="" method="POST">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" required />

                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" required />

                            <label for="mail">Email</label>
                            <input type="mail" id="mail" name="mail" required />

                            <label for="mdp">Mot de passe</label>
                            <input type="password" id="mdp" name="mdp" required />


                            <button>Valider</button>
                        </form>
                    </div>
                </div>
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