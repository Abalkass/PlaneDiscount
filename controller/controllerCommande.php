<?php
require_once ("$ROOT{$DS}model{$DS}modelCommande.php"); // chargement du modèle des commandes
require_once ("$ROOT{$DS}model{$DS}modelClient.php");   // chargement du modèle des clients
require_once ("$ROOT{$DS}config{$DS}Session.php");      // chargement la configuration des sessions des utilisateurs
require_once ("$ROOT{$DS}VerifFormulaire.php");         // chargement la fonction pour la vérification du formulaire

$erreur = false;

if (isset($_GET['action'])){
    $action = $_GET['action'];      // recupère l'action passée dans l'URL
} else {
    $action = null;
}

if(in_array($action, array('readAll', 'read', 'create', 'created', 'delete', 'update', 'updated'))) {
    if(in_array($action, array('created', 'delete', 'update', 'updated')) && !Session::is_admin()){
        $messageErreur = "Vous ne possédez pas les autorisations requises pour accéder à cette page.";
        $erreur = true;
    }
} else {
    $messageErreur = "La page que vous tentez d'accéder n'existe pas.";
    $erreur = true;
}

if (!$erreur) {
    switch ($action) {
        case "readAll":
            $tab_com = ModelCommande::getAllCommande();
            $view='All';
            $pagetitle='Liste des commandes';
            break;
            
        case "read":
            $id=$_GET['id'];
            $com = ModelCommande::getCommandeById($id);
            if ($com == null){
                $messageErreur = "Il n'y a aucune commande d'id : ". $id;
                $erreur = true;
            } else {
                $tab_prod = $com->findProduits($id);    //liste des produits contenu dans une commande
                $view='';
                $pagetitle='Détails d’une commande';
            }
            break;
            
         case "create":
            $tab_cli = ModelClient::getAllClient();
            $view='form';
            $pagetitle='Enregistrement d’une nouvelle commande';
            break;
            
        case "created":
            if (!empty(verifFormulaireCommande())){
                $messageErreur = verifFormulaireCommande() . '<br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=commande&action=create">Création d\'une commande</a>';
                $erreur = true;
            } else {
                $id_cli=$_POST['id_cli'];
                $com=new modelCommande($id_cli);
                $com->save();
                $id_com = $com->lastIdCommande();
                $date=date_format($com->getDateCommande(), 'd/m/Y');
                $etat=$com->getEtatCommande();
                $view='created';
                $pagetitle='Nouvelle commande créée';
            }
            break;
            
        case "delete":
            $id=$_GET['id'];
            $com_exist = ModelCommande::getCommandeById($id);
            if ($com_exist == null){
                $messageErreur = "Il n'y a aucune commande d'id : ". $id;
                $erreur = true;
            } else {
    			$com = ModelCommande::delete($id);
                $view='delete';
            	$pagetitle='Suppression d’une commande';
            }
            break;
            
        case "update":
            $id=$_GET['id'];
            $tab_cli = ModelClient::getAllClient();
    		$com = ModelCommande::getCommandeById($id);
    		$id_cli=$com->getIdClient();
            $date=$com->getDateCommande();
            $etat=$com->getEtatCommande();
            $view='form';
            $pagetitle='Modification d’une commande';
            break;
            
        case "updated":
            if (!empty(verifFormulaireCommande())){
                $messageErreur = verifFormulaireCommande() . '<br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=commande&action=update&id=' . $_POST['id'] . '">Modification d\'une commande</a>';
                $erreur = true;
            } else {
                $data[0]=$_POST['id'];
                $data[1]=$_POST['id_cli'];
                $data[2]=$_POST['date'];
                $data[3]=$_POST['etat'];
                $com = ModelCommande::getCommandeById($data[0]);
                $com->update($data);
                $view='updated';
                $pagetitle='Modification enregistrée';
            }
            break;


            
    }
}

if ($erreur) {
    $view = 'error';
    $pagetitle = 'Erreur';
}

require ("$ROOT{$DS}view{$DS}view.php");

?>