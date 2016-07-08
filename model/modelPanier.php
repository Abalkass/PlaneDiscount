<?php

    /**
     * Verifie si le panier existe, le créé sinon
     * @return booleen
     */
    function creationPanier(){
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['idProduit'] = array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }


    /**
     * Ajoute un article dans le panier
     * @param int $idProduit
     * @param string $libelleProduit
     * @param int $qteProduit
     * @param float $prixProduit
     * @return void
     */
    function ajouterArticle($idProduit, $libelleProduit, $qteProduit, $prixProduit){
        
        //Si le panier existe
        if (creationPanier() && !estVerrouille()){
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);

            if ($positionProduit !== false){
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
            } else{
                //Sinon on ajoute le produit
                array_push( $_SESSION['panier']['idProduit'],$idProduit);
                array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
                array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
                array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
            }
        } else {
            $messageErreur = "Un problème est survenu veuillez contacter l'administrateur du site.";
            $erreur = true;
        }
    }


    /**
     * Modifie la quantité d'un article
     * @param int $idProduit
     * @param int $qteProduit
     * @return void
     */
    function modifierQTeArticle($idProduit, $qteProduit){
        //Si le panier existe
        if (creationPanier() && !estVerrouille()){
          //Si la quantité est positive on modifie sinon on supprime l'article
          if ($qteProduit > 0){
            //Recherche du produit dans le panier
            $positionProduit = array_search($idProduit, $_SESSION['panier']['idProduit']);
            if ($positionProduit !== false)  $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
          } else
              supprimerArticle($idProduit);
        } else {
            $messageErreur = "Un problème est survenu veuillez contacter l'administrateur du site.";
            $erreur = true;
        }
    }

    /**
     * Supprime un article du panier
     * @param $idProduit
     * @return unknown_type
     */
    function supprimerArticle($idProduit){
        //Si le panier existe
        if (creationPanier() && !estVerrouille()){
            //Nous allons passer par un panier temporaire
            $tmp=array();
            $tmp['idProduit'] = array();
            $tmp['libelleProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++) {
                if ($_SESSION['panier']['idProduit'][$i] !== $idProduit){
                    array_push( $tmp['idProduit'], $_SESSION['panier']['idProduit'][$i]);
                    array_push( $tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                    array_push( $tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                    array_push( $tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
                }
            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] =  $tmp;
            //On efface notre panier temporaire
            unset($tmp);
        } else {
            $messageErreur = "Un problème est survenu veuillez contacter l'administrateur du site.";
            $erreur = true;
        }
    }


    /**
     * Montant total du panier
     * @return int
     */
    function montantGlobal(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++){
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }


    /**
     * Fonction de suppression du panier
     * @return void
     */
    function supprimePanier(){
        unset($_SESSION['panier']);
    }

    /**
     * Permet de savoir si le panier est verrouillé
     * @return booleen
     */
    function estVerrouille(){
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    /**
     * Compte le nombre d'articles différents dans le panier
     * @return int
     */
    function nbArticles() {
        if (isset($_SESSION['panier']))
            return count($_SESSION['panier']['idProduit']);
        else
            return 0;

    }

?>
