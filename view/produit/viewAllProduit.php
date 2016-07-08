<?php
if (empty($tab_prod)) {
    if (isset($type))   echo "<div class=\"titre\"> <h1>Il n'y a aucun produit de type : $type</h1><hr> </div>";
    else if (isset($constructeur))   echo "<div class=\"titre\"> <h1>Il n'y a aucun produit du constructeur : $constructeur</h1><hr> </div>";
    else if (isset($categorie))   echo "<div class=\"titre\"> <h1>Il n'y a aucun produit de categorie : $categorie</h1><hr> </div>";
    else  "<div class=\"titre\"> <h1>Il n'y a aucun produit dans la base de donnée</h1><hr> </div>";
} else {

    if (!Session::is_admin()) {

        if (isset($type))   echo "<div class=\"titre\"> <h1>Tous les produits de type : $type</h1><hr> </div>";
        else if (isset($constructeur))   echo "<div class=\"titre\"> <h1>Tous les produits du constructeur : $constructeur</h1><hr> </div>";
        else if (isset($categorie))   echo "<div class=\"titre\"> <h1>Tous les produits de categorie : $categorie</h1><hr> </div>";
        else echo "<div class=\"titre\"> <h1>Tous nos produits</h1><hr> </div>";

        echo '<div class="row marque">';

        foreach ($tab_prod as $prod) {
            $id = $prod->getIdProduit();
            $libelle=$prod->getLibelle();

            echo '<div class="col-sm-4">
                    <a href="index.php?controller=produit&amp;action=read&amp;id='.$prod->getIdProduit() .'">';
            if (file_exists("$DIR_IMG_PROD{$DS}$id.jpg"))   // si l'image du produit existe
                echo '<img src="images/produit/'.$prod->getIdProduit().'.jpg" class="img-thumbnail" alt="image produit"></a>';
            else
                echo '<img src="images/image-not-found.gif" class="img-thumbnail" alt="image produit"></a>';

            echo  '<p> <h4> <a href="index.php?controller=produit&amp;action=read&amp;id='.$prod->getIdProduit() .'">' . $prod->getLibelle() . '</a> </h4>
                    <br><i>' . $prod->getTypeAvion() . ' de ' . $prod->getConstructeur() . ' </i>
                    <br><div class="prix"> EUR  ' . $prod->getPrixUnitaire() . '</div>
                    <br><a class="btn btn-lg btn-primary" href="index.php?controller=panier&amp;action=ajout&amp;id='.$prod->getIdProduit() .'" role="button">Ajouter au panier</a>
                </div>';
            }

        echo '</div>';

        
    } else {
        echo '<a href="./index.php?controller=produit&amp;action=create" type="button" class="btn btn-primary btn-md btn-block">Créer un nouveau produit</a>
            <table class="table table-condensed table-striped table-hover table-responsive">
                <thead> <tr>
                    <th> IdProduit </th>
                    <th> Libéllé </th>
                    <th> Type d\'Avion </th>
                    <th> Constructeur </th>
                    <th> Nbre de Place </th>
                    <th> Dimansion (l x e x h) </th>
                    <th> Poids à Vide (en tonnes)</th>
                    <th> Vitesse Max (en km/h)</th>
                    <th> Prix unitaire (en euros)</th>
                    <th> Quantité Dispo </th>
                    <th class="colonne_icone"> Modifié </th>
                    <th class="colonne_icone"> Supprimé </th>
                </tr> </thead> <tbody>';

        foreach ($tab_prod as $prod)
            echo '<tr>
                    <td> <a href="index.php?controller=produit&amp;action=read&amp;id='.$prod->getIdProduit() .'">' . $prod->getIdProduit() . '</a> </td>
                    <td> ' . $prod->getLibelle() . '</td>
                    <td> ' . $prod->getTypeAvion() . '</td>
                    <td> ' . $prod->getConstructeur() . '</td>
                    <td> ' . $prod->getNbDePlace() . '</td>
                    <td> ' . $prod->getDimension() . '</td>
                    <td> ' . $prod->getPoidsAVide() . '</td>
                    <td> ' . $prod->getVitesseMax() . '</td>
                    <td> ' . $prod->getPrixUnitaire() . '</td>
                    <td> ' . $prod->getQteDispo() . '</td>
                    <td class="colonne_icone">     <!-- icône modification -->
                        <a href="index.php?controller=produit&amp;action=update&amp;id=' . $prod->getIdProduit() . '">
                        <span title="modifier les donnée de ce produit" class="glyphicon glyphicon-pencil"></span> </a>
                    </td>
                    <td class="colonne_icone">     <!-- icône suppression -->
                        <a href="index.php?controller=produit&amp;action=delete&amp;id=' . $prod->getIdProduit() . '">
                        <span title="supprimer ce produit" class="glyphicon glyphicon-remove"></span> </a>
                    </td>
                </tr>' ;


        echo '</tbody></table>';
    }
}
?>