<?php
    require "header.php";

    if (Session::is_admin() && $action!="admin"){
        switch ($controller) {
             case 'client':
                 require ("$ROOT{$DS}view{$DS}client{$DS}viewAdminClient.php");
                 break;

            case 'commande':
                 require ("$ROOT{$DS}view{$DS}commande{$DS}viewAdminCommande.php");
                 break;

            case 'produit':
                 require ("$ROOT{$DS}view{$DS}produit{$DS}viewAdminProduit.php");
                 break;
             
             default:
                 # code...
                 break;
         }            
    }

    if ($view == "error") require ("$ROOT{$DS}view{$DS}viewError.php");
    else {
        // Si $controleur='client' et $view='All',
        // alors $filepath=".../view/client/"
        //       $filename="viewAllClient.php";
        // et on charge '.../view/client/viewAllClient.php'
        $filepath = "{$ROOT}{$DS}view{$DS}{$controller}{$DS}";
        $filename = "view".ucfirst($view) . ucfirst($controller) . '.php';
        require "{$filepath}{$filename}";
    }


    require "footer.php";
?>
        
    