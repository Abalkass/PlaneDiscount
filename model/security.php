<?php
/**
* 
*/
class Security
{
	private static $seed = 'a5z4f9HG84d1àg96gh@s9eé8eds48SDùZs';

	public static function getSeed() {
	   return self::$seed;
	}

}

    /* Chiffrer le mot de passe de l'utilisateur */
    function chiffrer($texte_en_clair) {
        $texte_crypte = hash('sha256', $texte_en_clair);
        return $texte_crypte;
    }
   
?>