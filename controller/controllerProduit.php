<?php
require_once ("$ROOT{$DS}model{$DS}modelProduit.php");  // chargement du modèle produit
require_once ("$ROOT{$DS}config{$DS}Session.php");      // chargement la configuration des sessions des utilisateurs
require_once ("$ROOT{$DS}VerifFormulaire.php");         // chargement la fonction pour la vérification du formulaire
require_once ("$ROOT{$DS}Upload.php");                  // chargement la fonction upload de l'image du produit


$erreur = false;

if (isset($_GET['action'])){
    $action = $_GET['action'];      // recupère l'action passée dans l'URL
} else {
    $action="readAll";
}

if(in_array($action, array('readAll', 'read', 'create', 'created', 'delete', 'update', 'updated','search'))) {
    if(in_array($action, array('create', 'created', 'delete', 'update', 'updated')) && !Session::is_admin()){
        $messageErreur = "Vous ne possédez pas les autorisations requises pour accéder à cette page.";
        $erreur = true;
    }
} else {
    $messageErreur = "La page que vous tentez d'accéder n'existe pas.";
    $erreur = true;
}

$DIR_IMG_PROD = "$ROOT{$DS}images{$DS}produit";

if (!$erreur) {
    switch ($action) {
        case "readAll":
            if (isset($_GET['type'])){
                $type = $_GET['type'];
                $tab_prod = ModelProduit::getProduitByType($type);
            } else if (isset($_GET['constructeur'])){
                $constructeur = $_GET['constructeur'];
                $tab_prod = ModelProduit::getProduitByConstructeur($constructeur);
            }  else if (isset($_GET['categorie'])){
                $categorie = $_GET['categorie'];
                $tab_prod = ModelProduit::getProduitByCategorie($categorie);
            } else {
                $tab_prod = ModelProduit::getAllProduit();
            }
            $view='All';
            $pagetitle='Liste des produits';
            break;
            
        case "read": 
            $id=$_GET['id'];
            $prod = ModelProduit::getProduitById($id);
            if ($prod == null){
                $messageErreur = "Il n'y a aucun produit d'id : ". $id;
                $erreur = true;
            } else {
                $view='';
                $pagetitle='Détails d’un produit';
            }
            break;
            
         case "create":
            define('TAILLE_MAX', 1048576);    // Constante pour définir la taille max en octets de l’image
            $view='form';
            $pagetitle='Enregistrement d’un nouveau produit';
            break;
            
        case "created":
            if (!empty(verifFormulaireProduit())){
                $messageErreur = verifFormulaireProduit() . '<br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=produit&action=create">Création d\'un produit</a>';
                $erreur = true;
            } else {
                $libelle=$_POST['libelle'];
                $type=$_POST['type'];
                $constructeur=$_POST['constructeur'];
        		$place=$_POST['place'];
        		$dimension=$_POST['dimension'];
        		$poids=$_POST['poids'];
                $vitesse=$_POST['vitesse'];
                $prix=$_POST['prix'];
                $qte=$_POST['qte'];

                $id=intval (ModelProduit::lastIdProduit()) + 1;             // on définit l'idProduit pour le nom du fichier
                $nomImage = $id;                           // on génère un nom pour le'image, qui sera : "id-libelle.jpg"
                $errorUpload = uploadImage($nomImage);                      // on traite le transfère du l'image
                if ($errorUpload == null) {                                 // s'il n'y a pas d'erreur
                    $prod=new modelProduit($libelle, $type, $constructeur, $place, $dimension, $poids, $vitesse, $prix, $qte);
                    $prod->save();                                          // et puis on crée le produit
                    $message = "L'upload de l'image du produit est réussi.";// on affiche une une message de succès
                    $view='created';
                    $pagetitle='Nouveau produit créé';
                } else {    //sinon on redirige vers le formulaire
                    header('Location: ./index.php?controller=produit&action=create');
                }
            }
            break;
            
        case "delete":
            $id=$_GET['id'];
            $prod_exist = ModelProduit::getProduitById($id);
            if ($prod_exist == null){
                $messageErreur = "Il n'y a aucun produit d'id : ". $id;
                $erreur = true;
            } else {
                $libelle=$prod_exist->getLibelle();
                if (file_exists("$DIR_IMG_PROD{$DS}$id.jpg"))   // si l'image du produit existe
                    unlink("$ROOT{$DS}images{$DS}produit{$DS}$id.jpg");        // on le supprime 
    			$prod = ModelProduit::delete($id);
                $view='delete';
            	$pagetitle='Suppression d’un produit ';
            }
            break;
            
        case "update":
            $id=$_GET['id'];
    		$prod = ModelProduit::getProduitById($id);
    		$libelle=$prod->getLibelle();
            $type=$prod->getTypeAvion();
            $constructeur=$prod->getConstructeur();
    		$place=$prod->getNbDePlace();
    		$dimension=$prod->getDimension();
    		$poids=$prod->getPoidsAVide();
            $vitesse=$prod->getVitesseMax();
            $prix=$prod->getPrixUnitaire();
            $qte=$prod->getQteDispo();
            $view='form';
            $pagetitle='Modification d’un produit';
            break;
            
        case "updated":
            if (!empty(verifFormulaireProduit())){
                $messageErreur = verifFormulaireProduit() . '<br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=produit&action=update&id=' . $_POST['id'] . '">Modification d\'un produit</a>';
                $erreur = true;
            } else {
                $data[0]=$_POST['id'];
                $data[1]=$_POST['libelle'];
                $data[2]=$_POST['type'];
                $data[3]=$_POST['constructeur'];
        		$data[4]=$_POST['place'];
        		$data[5]=$_POST['dimension'];
        		$data[6]=$_POST['poids'];
                $data[7]=$_POST['vitesse'];
                $data[8]=$_POST['prix'];
                $data[9]=$_POST['qte'];
                $prod = ModelProduit::getProduitById($data[0]);

                if( !empty($_FILES['image']['name']) ) {                    // on verifie si le champ pour insérer une image est rempli
                    if (file_exists("$ROOT{$DS}images{$DS}produit{$DS}$data[0].jpg"))              // si l'image du produit existe
                        unlink("$ROOT{$DS}images{$DS}produit{$DS}$data[0].jpg");        // on supprime l'image du produit
                }
                $nomImage =  $data[0];                                      // on génère un nom pour le'image, qui sera : "id-libelle.jpg"
                $errorUpload = uploadImage($nomImage);                      // on traite le transfère du l'image
                if ($errorUpload == null) {                                 // s'il n'y a pas d'erreur
                    $message = "L'upload de l'image du produit est réussi.";// on affiche une une message de succès
                    $prod->update($data);                                   // et on fait la modification
                    $view='updated';
                    $pagetitle='Modification enregistrée';
                } else {    //sinon on redirige vers le formulaire
                    header('Location: ./index.php?controller=produit&action=update&id='.$data[0]);
                }
            }
            break;

        case "search":
           $data = $_POST['search'];
           $tab_prod = ModelProduit::rechercher($data);
           $view = 'search';
           $pagetitle ='Résulat de la recherche';
            
        break;
            
    }
}

if ($erreur) {
    $view = 'error';
    $pagetitle = 'Erreur';
}

require ("$ROOT{$DS}view{$DS}view.php");

?>