<?php
require_once ("$ROOT{$DS}model{$DS}modelPanier.php");   // chargement du modèle panier
require_once ("$ROOT{$DS}model{$DS}modelProduit.php");  // chargement du modèle produit
require_once ("$ROOT{$DS}model{$DS}modelCommande.php"); // chargement du modèle des commandes
require_once ("$ROOT{$DS}config{$DS}Session.php");      // chargement la configuration des sessions des utilisateurs

$erreur = false;

//récupération de la valeur de l'action s'il existe sinon on l'a met à null
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else
        $action = null;
}

if($action !== null) {
    if(!in_array($action,array('ajout', 'suppression', 'rafraichir', 'validation')))
    $erreur=true;

    //récuperation des variables en POST ou GET
    $id = (isset($_POST['id'])? $_POST['id']:  (isset($_GET['id'])? $_GET['id']:null )) ;
    $libelle = (isset($_POST['libelle'])? $_POST['libelle']:  (isset($_GET['libelle'])? $_GET['libelle']:null )) ;
    $prix = (isset($_POST['prix'])? $_POST['prix']:  (isset($_GET['prix'])? $_GET['prix']:null )) ;
    $qte = (isset($_POST['qte'])? $_POST['qte']:  (isset($_GET['qte'])? $_GET['qte']:null )) ;

    //Suppression des espaces verticaux
    $libelle = preg_replace('#\v#', '',$libelle);
    //On verifie que $prix soit un float
    $prix = floatval($prix);
    

    //On traite $qte qui peut etre un entier simple ou un tableau d'entier

    if (is_array($qte)){
        $QteArticle = array();
        $i=0;
        foreach ($qte as $contenu){
            $QteArticle[$i++] = intval($contenu);
        }
    } else
       $qte = intval($qte);
}

$view='';

if (!$erreur) {
    switch($action){
        case "ajout":
            if (!estVerrouille()) {
                $id=$_GET['id'];
                $prod = ModelProduit::getProduitById($id);
                $id = $prod->getIdProduit();
                $libelle = $prod->getLibelle();
                $qte_stock = $prod->getQteDispo();
                $prix = str_replace(" ", "", $prod->getPrixUnitaire());
                if ($qte_stock > 0){
                    $qte = 1;
                    ajouterArticle($id, $libelle, $qte, $prix);
                } else {
                    $messageErreur = "Impossible d'ajouter le produit dans le panier car le produit est épuisé dans le stock.";
                    $erreur = true;
                }
            } else {
                $messageErreur = "Vous ne pouvez pas ajouter un produit dans le panier car vous il y a une commande en cours. Veuillez d'abord la valider (c'est-à-dire la payer) pour pouvoir continuer.";
                $erreur = true;
            }
            break;

        case "suppression":
            supprimerArticle($id);
            break;

        case "rafraichir" :
            for ($i = 0 ; $i < count($QteArticle) ; $i++) {
                $id_prod=$_SESSION['panier']['idProduit'][$i];
                $prod = ModelProduit::getProduitById($id_prod);
                $qte_stock = $prod->getQteDispo();
                $qte_achete = round($QteArticle[$i]);
                if ($qte_achete <= $qte_stock) {
                    modifierQTeArticle($id_prod, $qte_achete);
                } else {
                    modifierQTeArticle($id_prod, $qte_stock);
                    $messageErreur = "La quantité d'article que vous voulez commande est supérieure à celle qu'on a en stock. En ce moment, il y n'a que $qte_stock produits disponibles.";
                }
            }
            break;

        case "validation":
            if (empty($_SESSION['idClient'])){
                header('Location: ./index.php?controller=client&action=connect');
                exit();
            } else {  
                $nbArticles=count($_SESSION['panier']['idProduit']);
                if ($nbArticles <= 0) {
                    $messageErreur = "Vous ne pouvez pas passer une commande vu que votre panier est vide.";
                    $erreur = true;
                } else {
                    $_SESSION['panier']['verrou']=true;
                    $com = new modelCommande($_SESSION['idClient']);
                    $com->save();
                    $id_com = $com->lastIdCommande();
                    for ($i=0 ; $i < $nbArticles ; $i++) {
                        $id_prod = $_SESSION['panier']['idProduit'][$i];
                        $qte = $_SESSION['panier']['qteProduit'][$i];
                        ModelCommande::addProduitSurCommande($id_com, $id_prod, $qte);
                        ModelProduit::decrementeQteDispo($id_prod, $qte);
                    }                    
                    supprimePanier();
                    header('Location: ./index.php?controller=client&action=read');
                }
            }
              
            break;
    }
}

if ($erreur) {
    $view = 'error';
    $pagetitle = 'Erreur';
}

require "$ROOT{$DS}view{$DS}view.php";

?>