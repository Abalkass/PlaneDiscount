<?php
	function uploadImage($nom) {
		    $ROOT = __DIR__;
    		$DS = DIRECTORY_SEPARATOR;
        /************************************************************
         * Definition des constantes
         *************************************************************/
        define('REPERTOIRE', "$ROOT{$DS}images{$DS}produit{$DS}");// Repertoire cible
        define('TAILLE_MAX', 1048576);	// Taille max en octets de l’image
        define('LARGEUR_MAX', 1200);    // Largeur max de l'image en pixels
        define('HAUTEUR_MAX', 1200);    // Hauteur max de l'image en pixels

        /************************************************************
         * Script d'upload
         *************************************************************/
        if( !empty($_FILES['image']['name']) ) {    //On verifie si le champ est rempli
	        if( !is_dir(REPERTOIRE) ) {				//Creation du repertoire cible si inexistant
	            if( !mkdir(REPERTOIRE, 0777) ) {
	                $messageErreur = 'Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposez des droits suffisants pour le faire ou créez le manuellement !';
	            }
	        } else {
            
                $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);   //Recuperation de l'extension de l’image
                $tabExt = array('jpg');
                
                if(in_array(strtolower($extension), $tabExt)) {   				//On verifie l'extension de l’image
                    $infosImg = getimagesize($_FILES['image']['tmp_name']);   	//On recupere les infos de l’image
                    
                    if($infosImg[2] >= 1 && $infosImg[2] <= 14) {     			//On verifie le type de l'image
                        
                        if(($infosImg[0] <= LARGEUR_MAX) && ($infosImg[1] <= HAUTEUR_MAX) && (filesize($_FILES['image']['tmp_name']) <= TAILLE_MAX))  {  //On vérifie les dimensions de l'image
                            
                            if(isset($_FILES['image']['error']) && UPLOAD_ERR_OK === $_FILES['image']['error']) {   //Parcours du tableau d'erreurs
                                $nomImage = $nom . '.' . $extension;     		// On renomme le image

                                /** Si c'est OK, on teste l'upload **/
                                if(move_uploaded_file($_FILES['image']['tmp_name'], REPERTOIRE.$nomImage)) {
                                    $messageErreur = null;
                                } else{// Sinon on affiche une erreur systeme
                                    $messageErreur = 'Problème lors de l’upload !';
                                }
                            } else {
                                $messageErreur = 'Une erreur interne a empêché l’uplaod de l’image';
                            }
                        } else {
                            // Sinon erreur sur les dimensions et taille de l'image
                            $messageErreur = 'Erreur dans les dimensions de l’image ou la taile du fichier! Dimension maximum : 1200 x 1200 et Taille maximum : 1 Mbits';
                        }
                    } else {
                        // Sinon erreur sur le type de l'image
                        $messageErreur = 'L’image à uploader n’est pas une image !';
                    }
                } else {
                    // Sinon on affiche une erreur pour l'extension
                    $messageErreur = 'L’extension de l’image est incorrecte !';
                }
            }

       	} else {
            $messageErreur = null;
        }
        /************************************************************
         * FIN du script d'upload
         *************************************************************/

        return $messageErreur;
	}
?>