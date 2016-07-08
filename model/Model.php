<?php
    require_once "$ROOT{$DS}config{$DS}Conf.php";
    class Model{
        public static $pdo;
        public static function Init(){
            $host = conf::getHostname();
            $dbname = conf::getDatabase();
            $login =  conf::getLogin();
            $pass = conf::getPassword();
            try{
                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",$login,$pass,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }           
                catch(PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
                
}
            
        }
        
    }
    Model::Init(); 
?>