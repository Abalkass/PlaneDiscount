<a href="./index.php?controller=client&amp;action=create" class="btn btn-primary btn-md btn-block">Créer un nouveau client</a>

<?php
if (empty($tab_cli)) {
    echo '<h3>La base de données ne contient aucun client.</h3>';
} else {
    echo '<table class="table table-striped table-hover table-responsive">
        <thead> <tr>
            <th> IdClient </th>
            <th> Nom </th>
            <th> Prénom </th>
            <th> Email </th>
            <th> Adresse </th>
            <th> Code postal </th>
            <th> Vile </th>
            <th> Téléphone </th>
            <th class="colonne_icone"> Modifié </th>
            <th class="colonne_icone"> Supprimé </th>
        </tr> </thead> <tbody>';

    	foreach ($tab_cli as $cli)
    		echo '<tr>
                    <td> <a href="index.php?controller=client&amp;action=read&amp;id='.$cli->getIdClient() .'">' . $cli->getIdClient() . '</a> </td>
                    <td> ' . $cli->getNomClient() . '</td>
                    <td> ' . $cli->getPrenomClient() . '</td>
                    <td> ' . $cli->getEmailClient() . '</td>
                    <td> ' . $cli->getAdresseClient() . '</td>
                    <td> ' . $cli->getCodePostal() . '</td>
                    <td> ' . $cli->getVilleClient() . '</td>
                    <td> ' . $cli->getTelephone() . '</td>
                    <td class="colonne_icone">     <!-- icône modification -->
                        <a href="index.php?controller=client&amp;action=update&amp;id=' . $cli->getIdClient() . '">
                        <span alt="modifier les donnée de ce client" class="glyphicon glyphicon-pencil"></span> </a>
                    </td>
                    <td class="colonne_icone">     <!-- icône suppression -->
                        <a href="index.php?controller=client&amp;action=delete&amp;id=' . $cli->getIdClient() . '">
                        <span alt="supprimer ce client" class="glyphicon glyphicon-remove"></span> </a>
                    </td>
                </tr>' ;
}
echo '</tbody></table>';
?>

