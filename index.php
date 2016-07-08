<?php
    session_start();
    
    $ROOT = __DIR__;
    $DS = DIRECTORY_SEPARATOR;
    $erreur = false;

    if (isset($_GET['controller'])){
        $controller = $_GET['controller'];

        if(!in_array($controller, array('client', 'commande', 'produit', 'panier'))) {
            $messageErreur = "La page que vous tentez d'accéder n'existe pas.";
            $erreur = true;
        } else {
            switch ($controller) {
                case "client":
                    require "$ROOT{$DS}controller{$DS}controllerClient.php";
                    break;
                    
                case "commande":
                    require "$ROOT{$DS}controller{$DS}controllerCommande.php";
                    break;
        			
        		case "produit":
                    require "$ROOT{$DS}controller{$DS}controllerProduit.php";
                    break;
        			
        		case "panier":
                    require "$ROOT{$DS}controller{$DS}controllerPanier.php";
                    break;
            }
        }
    } else {
        require "$ROOT{$DS}view{$DS}home.php";
    }

    if ($erreur) {
        $view = 'error';
        $pagetitle = 'Erreur';
    }
?>