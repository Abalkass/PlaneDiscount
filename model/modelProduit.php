<?php

require_once 'Model.php';
require_once 'modelCommande.php';

class ModelProduit{
    
    private $idProduit;
    private $libelle;
    private $typeAvion;
    private $constructeur;
    private $nbDePlace;
    private $dimension;
    private $poidsAVide;
    private $vitesseMax;
    private $prixUnitaire;
    private $qteDispo;
 
    //getters and setters
    
    public function getIdProduit() { 
        return $this->idProduit;  
    }
    public function getLibelle() {   
        return $this->libelle;   
    }
    public function getTypeAvion() {   
        return $this->typeAvion;   
    }
    public function getConstructeur() {   
        return $this->constructeur;   
    }
    public function getNbDePlace() {   
        return $this->nbDePlace;   
    }
    public function getDimension() {   
        return $this->dimension;   
    }
    public function getPoidsAVide() {   
        return $this->poidsAVide;   
    }
    public function getVitesseMax() {   
        return $this->vitesseMax;   
    }
    public function getPrixUnitaire() {   
        return number_format($this->prixUnitaire, 2, ',', ' ');  
    }	
    public function getQteDispo(){
        return $this->qteDispo;
    }
   
      //Un constructeur
    public function __construct($l = NULL, $t = NULL, $c = NULL, $n = NULL, $d =NULL, $poids = NULL, $v=NULL, $prix=NULL, $q = NULL) {
        if (!is_null($l) && !is_null($t) && !is_null($c) && !is_null($n) && !is_null($d) && !is_null($poids) && !is_null($v) && !is_null($prix) && !is_null($q)) {
            $this->libelle = $l;
            $this->typeAvion = $t;
            $this->constructeur = $c;
            $this->nbDePlace = $n;
            $this->dimension = $d;
            $this->poidsAVide = $poids;
            $this->vitesseMax = $v;
            $this->prixUnitaire = $prix;
            $this->qteDispo = $q;
           
        }
    }

	/* Retourne tous les produit de la base */
    static function getAllProduit() {
        $rep = Model::$pdo->query('SELECT *
								FROM PRODUIT');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $ans = $rep->fetchAll();
        return $ans;
    }
	
	/* Retourne les produits d'idProduit = $id */
    static function getProduitById($id) {
        $sql = "SELECT * 
				FROM PRODUIT
				WHERE idProduit=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "nom_var" => $id,
        );	 
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $req_prep->fetch();
    }

    /* Retourne les produits de type = $type */
    static function getProduitByType($type) {
        $sql = "SELECT * 
                FROM PRODUIT
                WHERE typeAvion=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":nom_var", $type);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $req_prep->fetchAll();
    }

    /* Retourne les produits du constructeur = $constructeur */
    static function getProduitByConstructeur($constructeur) {
        $sql = "SELECT * 
                FROM PRODUIT
                WHERE constructeur=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":nom_var", $constructeur);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $req_prep->fetchAll();
    }

    /* Retourne les produits de catégorie = $categorie */
    static function getProduitByCategorie($categorie) {
        switch ($categorie) {
            case 'civils':
                $sql = "SELECT * FROM PRODUIT
                        WHERE typeAvion='Avions de ligne' OR typeAvion='Avion-Cargo' OR typeAvion='Avions d\'affaire' OR typeAvion='Avions légers' OR typeAvion='ULM' ";
                break;

            case 'militaires':
                $sql = "SELECT * FROM PRODUIT
                        WHERE typeAvion='Avions de chasse' OR typeAvion='Avions de transport militaire' OR typeAvion='Avions de reconnaissance' ";
                break;

            case 'helico':
                $sql = "SELECT * FROM PRODUIT
                        WHERE typeAvion='Hélicoptères civils' OR typeAvion='Hélicoptères militaires' OR typeAvion='Hélicoptères de secourisme' ";
                break;
            
            default:
                $sql = null;
                break;
        }

        if (!empty($sql)) {
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(":nom_var", $categorie);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            return $req_prep->fetchAll();
        } else
            return null;
    }

	/* Enregistre un nouvel produit dans la base de données */
    function save() {
        $sql = "INSERT INTO PRODUIT (libelle, typeAvion, constructeur, nbDePlace, dimension, poidsAVide, vitesseMax, prixUnitaire, qteDispo)
				VALUES (:lib, :type, :const, :place, :dim, :poids, :vit, :prix, :qte)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            ":lib" => $this->libelle,
            ":type" => $this->typeAvion,
            ":const" => $this->constructeur,
            ":place" => $this->nbDePlace,
            ":dim" => $this->dimension,
            ":poids" => $this->poidsAVide,
            ":vit" => $this->vitesseMax,
			":prix" => $this->prixUnitaire,
			":qte" => $this->qteDispo,
            );
        $req_prep->execute($values);
    }

    /* Retourne le dernier id de la table Commande */
    function lastIdProduit() {
        $sql = "SELECT MAX(idProduit)
                FROM PRODUIT";
        $req_prep = Model::$pdo->prepare($sql);  
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        return $req_prep->fetchColumn();
    }

	/* Supprime le produit dont l'idProduit = $id */
    function delete($id){
       $sql = "DELETE FROM PRODUIT
	   			WHERE idProduit=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
			"nom_var" => $id,
		);
        $req_prep->execute($values);
    }
	
	/* Met à jour les données d'une produit qui sont dans le tableau $data */
    static function update($data){
        $sql = "UPDATE PRODUIT
                SET libelle = '$data[1]', typeAvion = '$data[2]', constructeur = '$data[3]', nbDePlace = '$data[4]', dimension = '$data[5]', poidsAVide = '$data[6]', vitesseMax = '$data[7]', prixUnitaire = '$data[8]', qteDispo = '$data[9]' 
                WHERE idProduit = '$data[0]'";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($data);
    }
	
    /* Retourne la quantité commandé du produit n° $idProd de la commande n° $idCom */
    public function qteCommandee($idProd, $idCom){
        $sql = "SELECT qteCommande
                FROM ESTCOMMANDE E
                WHERE E.idProduit=:prod AND E.idCommande=:com";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
			"prod" => $idProd,
            "com" => $idCom
		);
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        return $req_prep->fetchColumn();
    }
    
	/* Trouve tous les commande qui ont été fait de ce produit dont l'idProduit=$idProduit */
	public static function findCommandes($idProd) {
        $sql = "SELECT C.*, E.qteCommande
				FROM COMMANDE C
				JOIN ESTCOMMANDE E ON E.idProduit=P.idProduit
				WHERE E.idProduit =: nom_var";

        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":nom_var", $idProd);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_ASSOC);
        return $req_prep->fetch();
    }
    
    /* Met à jour la quantité disponible du produit $idProd en lui enlevant la quantité qui a été commandée */
    public static function decrementeQteDispo($idProd, $qteCommande){
        $sql = "UPDATE PRODUIT 
                SET qteDispo = qteDispo-:qteCom 
                WHERE idProduit =:id";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            ":qteCom" => $qteCommande,
            ":id" => $idProd
        );
        $req_prep->execute($values);
    }

    /* Recherche tous les produit correspondant à $données */
    public function rechercher($donnees){
        $requete = htmlspecialchars($donnees);
        $sql = "SELECT * 
                FROM PRODUIT 
                WHERE libelle LIKE '%$requete%' OR typeAvion LIKE '%$requete%' OR constructeur LIKE '%$requete%'";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS,"ModelProduit");
        return $req_prep->fetchAll();
    }
    
}

