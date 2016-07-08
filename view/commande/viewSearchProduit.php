<div class="titre">
    <h1>Recherche de produit</h1>
    <hr>

<?php
    if (empty($tab_prod)) {
    echo "<h2>Il n'existe aucun produit correspondant à la recherche : \"$data\"</h2></div>"; 
    }
    else{
    echo "<h2>Tous les produits correspondant à la recherche : \"$data\"</h2></div>";

        echo '<div class="row marque">';

        foreach ($tab_prod as $prod) {
            $id = $prod->getIdProduit();
            $libelle=$prod->getLibelle();

            echo '<div class="col-sm-4">
                    <a href="index.php?controller=produit&amp;action=read&amp;id='.$prod->getIdProduit() .'">';
            if (file_exists("$DIR_IMG_PROD{$DS}$id-$libelle.jpg"))   // si l'image du produit existe
                echo '<img src="images/produit/'. $prod->getIdProduit() . '.jpg" class="img-thumbnail" alt="image produit"></a>';
            else
                echo '<img src="images/image-not-found.gif" class="img-thumbnail" alt="image produit"></a>';

            echo  '<p> <h4> <a href="index.php?controller=produit&amp;action=read&amp;id='.$prod->getIdProduit() .'">' . $prod->getLibelle() . '</a> </h4>
                    <br><i>' . $prod->getTypeAvion() . ' de ' . $prod->getConstructeur() . ' </i>
                    <br><div class="prix"> EUR  ' . $prod->getPrixUnitaire() . '</div>
                    <br><a class="btn btn-lg btn-primary" href="index.php?controller=panier&amp;action=ajout&amp;id='.$prod->getIdProduit() .'" role="button">Ajouter au panier</a></p>
                </div>';
            }

        echo '</div>';
   
    }
    
?>