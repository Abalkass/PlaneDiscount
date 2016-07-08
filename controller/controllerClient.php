<?php
require_once ("$ROOT{$DS}model{$DS}modelClient.php");   // chargement du modèle Client
require_once ("$ROOT{$DS}model{$DS}security.php");      // chargement la sécurité pour mdp
require_once ("$ROOT{$DS}config{$DS}Session.php");      // chargement la configuration des sessions des utilisateurs
require_once ("$ROOT{$DS}VerifFormulaire.php");         // chargement la fonction pour la vérification du formulaire

$erreur = false;

if (isset($_GET['action'])){
    $action = $_GET['action'];      // recupère l'action passée dans l'URL
} else {
    $action="connect";
}

if(in_array($action, array('readAll', 'read', 'create', 'created', 'delete', 'update', 'updated', 'updatePWD', 'updatePWD', 'connect', 'connected', 'deconnect', 'admin'))) {
    if(in_array($action,array('read', 'delete', 'update', 'updatePWD'))) {
        if (!empty($_SESSION['idClient'])){
            $id=$_SESSION['idClient'];
        } else if (Session::is_admin()){
            $id=$_GET['id'];
        } else {
            $action="connect";
        }
    }
} else {
    $messageErreur = "La page que vous tentez d'accéder n'existe pas.";
    $erreur = true;
}

if (!$erreur) {
    switch ($action) {
        case "readAll":
            if (Session::is_admin()){
                $tab_cli = ModelClient::getAllClient();
                $view='All';
                $pagetitle='Liste des clients';
            } else {
                $messageErreur = "Vous ne possédez pas les autorisations requises pour accéder à cette page.";
                $erreur = true;
            }
            break;
            
        case "read":
            $cli = ModelClient::getClientById($id);
            if ($cli == null){
                $messageErreur = 'Erreur : Le client n° ' . $id . ' n\'existe pas !';
                $erreur = true;
            } else {
                $tab_com = $cli->getAllCommandeClient($id);     //Liste de tous les commandes du client
                $view='';
                $pagetitle='Détails d’un client';
            }
            break;
            
        case "create":
            if (empty($_SESSION['idClient'])){
                $view='form';
                $pagetitle='Enregistrement d’un nouveau client';
            } else {
                $messageErreur = "Déconnectez-vous avant, si vous voulez créer un nouveau compte.";
                $erreur = true;
            }
            break;
            
        case "created":
            if (!empty(verifFormulaireClient())){
                $messageErreur = verifFormulaireClient() . '<br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=client&action=create">Création d\'un nouveau client</a>';
                $erreur = true;
            } else if ($_POST['pwd'] != $_POST['pwdConfirm']) {
                $messageErreur = 'ERREUR : Les mots de passe saisis ne se correspondent pas ! <br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=client&action=create">Création d\'un nouveau client</a>';
                $erreur = true;
            } else {
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $email=$_POST['email'];
                $mdp=chiffrer($_POST['pwdConfirm'].security::getSeed());
                $adresse=$_POST['adresse'];
        		$cp=$_POST['cp'];
        		$ville=$_POST['ville'];
        		$tel=$_POST['tel'];
                $cli=new modelClient($nom, $prenom, $email, $mdp, $adresse, $cp, $ville, $tel);
                $cli->save();
                $view='created';
                $pagetitle='Nouveau client créée';
            }
            break;
            
        case "delete":
            $cli_exist = ModelClient::getClientById($id);
            if ($cli_exist == null){
                $messageErreur = 'Erreur : Le client n° ' . $id . ' n\'existe pas !';
                $erreur = true;
            } else {
                $nom=$cli_exist->getNomClient();
                $prenom=$cli_exist->getPrenomClient();
    			$cli = ModelClient::delete($id);
                if (!empty($_SESSION['idClient'])){
                    unset($_SESSION['idClient']);
                }
                $view='delete';
            	$pagetitle='Suppression d’un client ';
            }
            break;
            
        case "update":
    		$cli = ModelClient::getClientById($id);
    		$nom=$cli->getNomClient();
            $prenom=$cli->getPrenomClient();
            $email=$cli->getEmailClient();
            $adresse=$cli->getAdresseClient();
    		$cp=$cli->getCodePostal();
    		$ville=$cli->getVilleClient();
    		$tel=$cli->getTelephone();
            $view='form';
            $pagetitle='Modification d’un client';
            break;
            
        case "updated":
            if (!empty(verifFormulaireClient())){
                $messageErreur = verifFormulaireClient() . '<br>Veuillez réessayer en retournant la page précédente : <a href="./index.php?controller=client&action=update&id=' . $_POST['id'] . '">Modification d\'un client</a>';
                $erreur = true;
            } else {
                $data[0]=$_POST['id'];
                $data[1]=$_POST['nom'];
                $data[2]=$_POST['prenom'];
                $data[3]=$_POST['email'];
                $data[4]=$_POST['adresse'];
        		$data[5]=$_POST['cp'];
        		$data[6]=$_POST['ville'];
        		$data[7]=$_POST['tel'];
                $cli = ModelClient::getClientById($data[0]);
                $cli->update($data);
                if (isset($_POST['admin']))
                    $cli->clientIsAdimin($_POST['id'], 1);
                else
                    $cli->clientIsAdimin($_POST['id'], 0);
                $view='updated';
                $pagetitle='Modification enregistrée';
            }
            break;

        case "updatePWD":
            $cli = ModelClient::getClientById($id);
            $view='updatePWD';
            $pagetitle='Modification mot de passe';
            break;

        case "updatedPWD":
            $id=$_POST['id'];
            $cli = ModelClient::getClientById($id);

            if ( chiffrer($_POST['pwdOld'].security::getSeed() )!= $cli->getMDPClient() ) {
                $messageErreur = "ERREUR : Le mot de passe saisi ne correspond pas à votre mot de passe actuel. Veuillez ressayer de nouveau.";
                $view='updatePWD';
                $pagetitle='Modification mot de passe';
            } else if ($_POST['pwdNew'] != $_POST['pwdConfirm']) {
                $messageErreur = "ERREUR : Les nouveaux mots de passe saisis ne se correspondent pas !. Veuillez ressayer de nouveau.";
                $view='updatePWD';
                $pagetitle='Modification mot de passe';
            } else {
                $view='updatedPWD';
                $pagetitle='Mot de passe modifié';
                $data[0]=$id;
                $data[1]=chiffrer($_POST['pwdConfirm'].security::getSeed());
                $cli->updatePWD($data);
            }
            break;

        case "connect":
            if (Session::is_admin()){
                header('Location: ./index.php?controller=client&action=admin');
            } else if (!empty($_SESSION['idClient'])) {
                header('Location: ./index.php?controller=client&action=read');
            } else {
                $view='connect';
                $pagetitle='Connexion';
            }
            break;
            
        case "connected":
            $email=$_POST['email'];
            $mdp=chiffrer($_POST['pwd'].security::getSeed());
            $cli = ModelClient::checkPassword($email, $mdp);
            if (empty($cli)){
                $messageErreur = "Les identifiants saisis ne sont pas valides. Veuillez ressayer de nouveau.";
                $view='connect';
                $pagetitle='Connexion';
            } else {
                if ($cli->getIsAdmin()) {
                    $_SESSION['admin'] = true;
                    header('Location: ./index.php?controller=client&action=admin');
                } else {
                    $_SESSION['idClient']=$cli->getIdClient();
                    $pagetitle='Votre compte';
                    header('Location: ./index.php?controller=client&action=read');
                    exit();
                }  
            }

            break;

        case "deconnect":
            session_destroy();
            header('Location: ./index.php');
            exit();
            break;

        case "admin":
            if (Session::is_admin()) {
                $pagetitle='Compte administrateur';
                $view='admin';
            } else {
                $messageErreur = "Vous ne possédez pas les autorisations requises pour accéder à cette page.";
                $erreur = true;
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