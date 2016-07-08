<?php

require_once 'Model.php';
require_once 'modelProduit.php';

class ModelCommande{
    
    private $idCommande;
    private $idClient;
    private $dateCommande;
    private $etatCommande;
 
    //getters
    
    public function getIdCommande() { 
        return $this->idCommande;  
    }
    public function getIdClient() {   
        return $this->idClient;   
    }
    public function getDateCommande(){
        return $this->dateCommande;
    }
    public function getEtatCommande() {
        return $this->etatCommande;
    }
    
    //Un constructeur
    public function __construct($i = NULL) {
        if (!is_null($i)) {
            $this->idClient = $i;
            $this->dateCommande = new DateTime();
            $this->etatCommande = "En attente de cofirmation";
           
        }
    }
        
    /* Retourne tous les commande de la base */
    static function getAllCommande() {
        $rep = Model::$pdo->query('SELECT *
				                FROM COMMANDE');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        $ans = $rep->fetchAll();
        return $ans;
    }
	
	/* Retourne les informations du commande dont son idCommande = $id */
	static function getCommandeById($id) {
        $sql = "SELECT * 
                FROM COMMANDE
                WHERE idCommande=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "nom_var" => $id,
        );	 
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        return $req_prep->fetch();
    }
    
	/* Enregistre une nouvelle commande dans la base de données */
    function save() {
        $sql = "INSERT INTO COMMANDE(idClient, dateCommande, etatCommande)
				VALUES (:id,:date,:etat)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            ":id" => $this->idClient,
            ":date" => date_format($this->dateCommande, 'd/m/Y'),
            ":etat" => $this->etatCommande,
            );
        $req_prep->execute($values);
    }

    /* Retourne le dernier id de la table Commande */
    function lastIdCommande() {
        $sql = "SELECT MAX(idCommande)
                FROM COMMANDE";
        $req_prep = Model::$pdo->prepare($sql);  
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        return $req_prep->fetchColumn();
    }

	/* Supprime la commande dont l'idClommande = $id*/
    function delete($id){
       $sql = "DELETE  "
            . "FROM COMMANDE "
            . "WHERE idCommande=:nom_var";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("nom_var" => $id,);
        $req_prep->execute($values);
    }
	
	/* Met à jour les données d'une commande qui sont dans le tableau $data */
    static function update($data){
        $sql = "UPDATE COMMANDE
                SET idClient = '$data[1]', dateCommande = '$data[2]', etatCommande = '$data[3]' 
                WHERE idCommande = '$data[0]'";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($data);
    }

    /* Retourne le prix total de la commande $id */
    public function total($id){
        $sql = "SELECT sum(E.qteCommande*P.prixUnitaire)
                FROM ESTCOMMANDE E
                JOIN PRODUIT P ON P.idProduit = E.idProduit
                WHERE E.idCommande=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":nom_var", $id);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        return $req_prep->fetchColumn();
    }
    
    /* Trouve tous les produits d'une comande dont l'id=$idCom */
    public static function findProduits($idCom){
        $sql = "SELECT P.idProduit, P.libelle, P.prixUnitaire, E.qteCommande
                FROM PRODUIT P
                JOIN ESTCOMMANDE E ON E.idProduit=P.idProduit
                WHERE E.idCommande=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":nom_var", $idCom);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_ASSOC);
        return $req_prep->fetchAll();
    }

    /* Ajoute le produit d'id $idProd à la commande d'id $idCom */
    function addProduitSurCommande($idCom, $idProd, $qte) {
        $sql = "INSERT INTO ESTCOMMANDE(idCommande, idProduit, qteCommande)
                VALUES (:idC, :idP, :qte)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            ":idC" => $idCom,
            ":idP" => $idProd,
            ":qte" => $qte
            );
        $req_prep->execute($values);
    }

}

