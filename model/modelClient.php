<?php

require_once 'Model.php';

class ModelClient {
    
    private $idClient;
    private $nomClient;
    private $prenomClient;
    private $email;
    private $mdpClient;
    private $adresseClient;
	private $codePostal;
	private $villeClient;
	private $telephone;
    private $admin;
   

    //getters
	
    public function getIdClient() {
        return $this->idClient;
    }

    public function getNomClient() {
        return $this->nomClient;
    }

    public function getPrenomClient() {
        return $this->prenomClient;
    }

    public function getEmailClient() {
        return $this->email;
    }

    public function getMDPClient() {
        return $this->mdpClient;
    }
	
    public function getAdresseClient() {
        return $this->adresseClient;
    }
	
	public function getCodePostal() {
        return $this->codePostal;
    }
	
	public function getVilleClient() {
        return $this->villeClient;
    }
	
	public function getTelephone() {
        return $this->telephone;
    }

    public function getIsAdmin() {
        return $this->admin;
    }
	    

    //Un constructeur
    public function __construct($n = NULL, $p = NULL, $e = NULL, $pw = NULL, $a = NULL, $c = NULL, $v = NULL, $t = NULL) {
        if (!is_null($n) && !is_null($p) && !is_null($a) && !is_null($c) && !is_null($v) && !is_null($t)) {

            $this->nomClient = $n;
            $this->prenomClient = $p;
            $this->email = $e;
            $this->mdpClient = $pw;
            $this->adresseClient = $a;
			$this->codePostal = $c;
			$this->villeClient = $v;
			$this->telephone = $t;
        }
    }
	
	/* Retourne tous les cliens de la base */
    static function getAllClient() {
        $rep = Model::$pdo->query('SELECT * FROM CLIENT');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $ans = $rep->fetchAll();
        return $ans;
    }

	/* Retourne les informations du client dont son idClient est $id */
    static function getClientById($id) {
        $sql = "SELECT *
				FROM CLIENT
				WHERE idClient=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "nom_var" => $id,
        ); 
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        return $req_prep->fetch();
    }

	/* Enregistre un nouvelle client dans la base de données */
    function save() {
        $sql = "INSERT INTO CLIENT(nomClient, prenomClient, email, mdpClient, adresseClient, codePostal, villeClient, telephone)
				VALUES (:nom, :prenom, :mail, :mdp, :adresse, :codePostal, :villeClient, :telephone)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            ":nom" => $this->nomClient,
			":prenom" => $this->prenomClient,
            ":mail" => $this->email,
            ":mdp" => $this->mdpClient,
			":adresse" => $this->adresseClient,
			":codePostal" => $this->codePostal,
			":villeClient" => $this->villeClient,
			":telephone" => $this->telephone,
        );
        $req_prep->execute($values);
    }

	/* Supprime le client dont l'idClient = $id*/
    function delete($id){
       $sql = "DELETE FROM CLIENT "
            . "WHERE idClient=:nom_var";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("nom_var" => $id,);
        $req_prep->execute($values);
    }
	
	/* Met à jour les données du client qui sont dans le tableau $data*/
    static function update($data){
        $sql = "UPDATE CLIENT
                SET nomClient = '$data[1]', prenomClient = '$data[2]', email = '$data[3]', adresseClient = '$data[4]', codePostal = '$data[5]', villeClient = '$data[6]', telephone = '$data[7]'
                WHERE idClient = '$data[0]'";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($data);
    }
    
    /* Met à jour le mot de passe du client dont l'idClient = $id*/
    static function updatePWD($data){
        $sql = "UPDATE CLIENT
                SET mdpClient = '$data[1]'
                WHERE idClient = '$data[0]'";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute($data);
    }

    /* Change le client dont l'idClient = $id en administrateur*/
    static function clientIsAdimin($id, $boolean){
        $sql = "UPDATE CLIENT
                SET admin=:bool
                WHERE idClient=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            ":nom_var" => $id,
            ":bool" => $boolean
        );
        $req_prep->execute($values);
    }
    
    /* Retourne tous les commande qu'a passé le cilient d'id $idClient*/
    static function getAllCommandeClient($idClient){
        $sql = "SELECT com.idCommande, com.dateCommande,com.etatCommande
                FROM COMMANDE com
                JOIN CLIENT cli ON cli.idClient=com.idClient
                WHERE com.idClient=:nom_var";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":nom_var", $idClient);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_ASSOC);        
        return $req_prep->fetchAll();
    }

    /* Retourne les infos du client dont l'email est $email et son mot de passe crypté est $mdp_crypte.   */
    function checkPassword($email, $mdp_crypte) {
        $sql = "SELECT *
                FROM CLIENT
                WHERE email=:mail AND mdpClient=:mdp";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "mail" => $email,
            "mdp" => $mdp_crypte
        ); 
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        return $req_prep->fetch();
    }

}

?>
