<?php
	echo '<p> Identifiant : ' . $cli->getIdClient() .
		'<br> Nom : ' . $cli->getNomClient() .
		'<br> Prénom : ' . $cli->getPrenomClient() .
        '<br> Email : ' . $cli->getEmailClient() .
		'<br> Adresse : ' . $cli->getAdresseClient() .
		'<br> Code postal : ' . $cli->getCodePostal() .
		'<br> Ville : ' . $cli->getVilleClient() .
		'<br> Téléphone : ' . $cli->getTelephone() . '</p>';

    if (empty($tab_com)) {
        echo '<h3>' . $cli->getNomClient() . ' ' . $cli->getPrenomClient() . ' n\'a effectué aucune commande à ce jour.</h3>';
    } else {
        echo '<h3> Liste des commandes qui ont passé par ' . $cli->getNomClient() . ' ' . $cli->getPrenomClient() . ': </h3>
            <hr>
            <table class="table table-striped table-hover table-responsive">
            <thead> <tr>
                    <th> IdCommande </th>
                    <th> Date </th>
                    <th> Etat de la commande </th>';
        if (Session::is_admin()) { echo '
                    <th class="colonne_icone"> Modifié </th>
                    <th class="colonne_icone"> Supprimé </th>';}
        echo'</tr> </thead> <tbody>';

    	foreach ($tab_com as $com) {
            echo '<tr>
                    <td> <a href="index.php?controller=commande&action=read&id=' . $com["idCommande"] . '">' . $com["idCommande"] . '</a> </td>            
                    <td> ' . $com["dateCommande"] . '</td>
                    <td> ' . $com["etatCommande"].'</td>';
            if (Session::is_admin()) { echo '
                    <td class="colonne_icone">     <!-- icône modification -->
                        <a href="index.php?controller=commande&action=update&id=' . $com["idCommande"] . '">
                        <span title="modifier les donnée de cette commande" class="glyphicon glyphicon-pencil"></span> </a>
                    </td>
                    <td class="colonne_icone">     <!-- icône suppression -->
                        <a href="index.php?controller=commande&action=delete&id=' . $com["idCommande"] . '">
                        <span title="supprimer cette commande" class="glyphicon glyphicon-remove"></span> </a>
                    </td>';}
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
    echo '
        <p> Si vous voulez modifier les informations de ce client, <a href="index.php?controller=client&amp;action=update&amp;id=' . $cli->getIdClient() . '"> cliquez-ici !</a> </p>
        <p> Si vous voulez modifier le mot de passe ce client, <a href="index.php?controller=client&amp;action=updatePWD&amp;id=' . $cli->getIdClient() . '"> cliquez-ici !</a> </p>
        <p> Si vous voulez suppprimer ce client, <a href="index.php?controller=client&amp;action=delete&amp;id=' . $cli->getIdClient() . '"> cliquez-ici !</a> </p>';
?>
