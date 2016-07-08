<?php
	echo '<p> Identifiant de la commande : ' . $com->getIdCommande() .
		'<br> Identifiant du client : ' . $com->getIdClient() .
		'<br> Date de la commande : ' . $com->getDateCommande() .
		'<br> Etat de la commande : ' . $com->getEtatCommande() .
		'<br> Prix Total : ' . $com->total($com->getIdCommande()) . '</p>';

    if (empty($tab_prod)) {
        echo '<h3>Il n\'y a aucun produit pour la commande n° ' . $com->getIdCommande() . '.</h3>';
    } else {
        echo '<h3> Liste des produits achetés pour cette commande : </h3>
        <table class="table table-striped table-hover table-responsive">
        <thead> <tr>
            <th> IdProduit </th>
            <th> Libéllé </th>
            <th> Prix unitaire (en euros) </th>
            <th> Quantité commandée </th>';
    if (Session::is_admin()) { echo '
            <th class="colonne_icone"> Modifié </th>
            <th class="colonne_icone"> Supprimé </th>';}
    echo'</tr> </thead> <tbody>';

    	foreach ($tab_prod as $prod) {
            echo '<tr>
                    <td> <a href="index.php?controller=produit&amp;action=read&amp;id='. $prod["idProduit"] .'">' . $prod["idProduit"] . '</a> </td>            
                    <td> ' . $prod["libelle"] . '</td>
                    <td> ' . $prod["prixUnitaire"].'</td>
                    <td> ' . $prod["qteCommande"] . '</td>';
            if (Session::is_admin()) { echo '
                    <td class="colonne_icone">     <!-- icône modification -->
                        <a href="index.php?controller=produit&amp;action=update&amp;id=' . $prod["idProduit"] . '">
                        <span title="modifier les donnée de ce produit" class="glyphicon glyphicon-pencil"></span> </a>
                    </td>
                    <td class="colonne_icone">     <!-- icône suppression -->
                        <a href="index.php?controller=produit&amp;action=delete&amp;id=' . $prod["idProduit"] . '">
                        <span title="supprimer ce produit" class="glyphicon glyphicon-remove"></span> </a>
                    </td>';}
            echo '</tr>';
        }

        echo '</tbody></table>';
    }
    echo'
        <p> Si vous voulez modifier les informations de cette commande, <a href="index.php?controller=commande&amp;action=update&amp;id=' . $com->getIdCommande() . '"> cliquez-ici !</a> </p>

        <p> Si vous voulez suppprimer cette commande, <a href="index.php?controller=commande&amp;action=delete&amp;id=' . $com->getIdCommande() . '"> cliquez-ici !</a> </p>';
?>
