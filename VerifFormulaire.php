<?php
	function verifFormulaireClient() {
		// Vérification du nom
		if(!isset($_POST['nom']) && !preg_match("/^[A-Za-z0-9\C0-\xFF\x20\x2D].{1,}$/i", $_POST['nom']) ){
			$messageErreur="Vous n'avez pas saisi un nom valide !";
		}
		// Vérification du prénom
		else if(!isset($_POST['prenom']) && !preg_match("/^[A-Za-z0-9\C0-\xFF\x20\x2D].{1,}$/i", $_POST['prenom']) ){
			$messageErreur="Vous n'avez pas saisi un prenom valide !";
		}

		// Vérification de l'email
		else if(!isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$messageErreur="Vous n'avez pas saisi un e-mail valide !";
		}
		else if ($_GET['action']=="create") {
			// Vérification du mot de passe
			if(!isset($_POST['pwd']) && !preg_match("/^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[A-Z])(?=.*[0-9])(?=.*\\W))|((?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$/i", $_POST['pwd']) ){
				$messageErreur="Vous n'avez pas saisi un mot de passe valide !";
			}
		}
		// Vérification de l'adresse
		else if(!isset($_POST['adresse'])){
			$messageErreur="Vous n'avez pas saisi une adresse !";
		}
		// Vérification du code postal
		else if(!isset($_POST['cp']) && !preg_match("/^[0-9]{5}$/i",$_POST['cp']) && strlen($_POST['cp']) == 5){
			$messageErreur="Vous n'avez pas saisi un code postal valide !";
		}
		// Vérification de l'adresse
		else if(!isset($_POST['ville'])){
			$messageErreur="Vous n'avez pas saisi une ville !";
		}
		// Vérification du téléphone
		else if (!isset($_POST['tel']) && !preg_match("/^[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}$/i", $_POST['tel']) && strlen($_POST['tel']) == 10){
				$messageErreur="Vous n'avez pas saisi un numéro de téléphone valide !";
		}
		else $messageErreur=null;

		return $messageErreur;
	}

	function verifFormulaireCommande() {
		// Vérification de l'idClient
		if(!isset($_POST['id_cli'])){
			$messageErreur="Vous n'avez pas saisi un identifiant du client !";
		}
		else if ($_GET['action']=="update") {
			// Vérification de la date de la commande
			if(!isset($_POST['date']) && !preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/i", $_POST['date']) && strlen($_POST['date']) == 10 ){
				$messageErreur="Vous n'avez pas saisi un date valide !";
			}
			// Vérification de l'état de la commande
			else if(!isset($_POST['etat']) && !preg_match("/^[A-Za-z0-9\C0-\xFF\x20\x2D].{1,}$/i", $_POST['etat']) ){
				$messageErreur="Vous n'avez pas saisi un état valide !";
			}
		}
		else $messageErreur=null;

		return $messageErreur;
	}

	function verifFormulaireProduit() {
		// Vérification du libelle
		if(!isset($_POST['libelle']) && !preg_match("/^[A-Za-z0-9\C0-\xFF\x20\x2D].{1,}$/i", $_POST['libelle']) ){
			$messageErreur="Vous n'avez pas saisi un libéllé valide !";
		}
		// Vérification du type
		else if(!isset($_POST['type']) && !preg_match("/^[A-Za-z0-9\C0-\xFF\x20\x2D].{1,}$/i", $_POST['type']) ){
			$messageErreur="Vous n'avez pas saisi un type de produit valide !";
		}
		// Vérification du constructeur
		else if(!isset($_POST['constructeur']) && !preg_match("/^[A-Za-z0-9\C0-\xFF\x20\x2D].{1,}$/i", $_POST['constructeur']) ){
			$messageErreur="Vous n'avez pas saisi un constructeur de produit valide !";
		}
		// Vérification du nombre de place
		else if(!isset($_POST['place']) && !preg_match("/^[0-9].{1,}$/i", $_POST['place']) ){
			$messageErreur="Vous n'avez pas saisi un nombre de place valide ! Le nombre de place doit être un entier.";
		}
		// Vérification de la dimension
		else if(!isset($_POST['dimension']) && !preg_match("/^[0-9]{1,}x[0-9]{1,}x[0-9]{1,}$/i", $_POST['dimension']) ){
			$messageErreur="Vous n'avez pas saisi une dimension valide ! La dimension doit être au format LongueurxEnvergurexHauteur";
		}
		// Vérification du poids à vide
		else if(!isset($_POST['poids']) && !preg_match("/^[0-9].{1,}$/i", $_POST['poids']) ){
			$messageErreur="Vous n'avez pas saisi un poids valide ! Le poids à vide doit être un entier.";
		}
		// Vérification de la vitesse
		else if(!isset($_POST['vitesse']) && !preg_match("/^[0-9].{1,}$/i", $_POST['vitesse']) ){
			$messageErreur="Vous n'avez pas saisi une vitesse valide ! La vitesse maximal doit être un entier.";
		}
		// Vérification du prix
		else if(!isset($_POST['prix']) && !preg_match("/^([0-9]{1,}|([0-9]{1,},[0-9]{1,}))$/i", $_POST['prix']) ){
			$messageErreur="Vous n'avez pas saisi un prix valide ! Le prix est un décimal.";
		}
		// Vérification de la quantité disponible
		else if(!isset($_POST['qte']) && !preg_match("/^[0-9].{1,}$/i", $_POST['qte']) ){
			$messageErreur="Vous n'avez pas saisi une quantité valide ! La quantité disponible doit être un entier.";
		}
		else $messageErreur=null;

		return $messageErreur;
	}


