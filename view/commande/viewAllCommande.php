<?php
if (Session::is_admin()) {
    echo '<a href="./index.php?controller=commande&amp;action=create" class="btn btn-primary btn-md btn-block">Créer une nouvelle commande</a>';
}

if (empty($tab_com)) {
    echo '<h3>La base de données ne contient aucune commande.</h3>';
} else {
    echo '<table class="table table-condensed table-striped table-hover table-responsive">
    <thead> <tr>
        <th> IdCommande </th>
        <th> IdClient </th>
        <th> Date de la commande </th>
        <th> Etat de la commande </th>
        <th> Prix Total </th>
        <th class="colonne_icone"> Modifié </th>
        <th class="colonne_icone"> Supprimé </th>
    </tr> </thead> <tbody>';

	foreach ($tab_com as $com)
		echo '<tr>
                <td> <a href="index.php?controller=commande&amp;action=read&amp;id='. $com->getIdCommande() . '">' . $com->getIdCommande() . '</a> </td>
                <td> <a href="index.php?controller=client&amp;action=read&amp;id='.$com->getIdClient() .'">' . $com->getIdClient() . '</a> </td>              
                <td> ' . $com->getDateCommande() . '</td>
                <td> ' . $com->getEtatCommande() . '</td>
                <td> ' . $com->total($com->getIdCommande()) . '</td>
                <td class="colonne_icone">     <!-- icône modification -->
                    <a href="index.php?controller=commande&amp;action=update&amp;id=' . $com->getIdCommande() . '">
                    <span title="modifier les donnée de cette commande" class="glyphicon glyphicon-pencil"></span> </a>
                </td>
                <td class="colonne_icone">     <!-- icône suppression -->
                    <a href="index.php?controller=commande&amp;action=delete&amp;id=' . $com->getIdCommande() . '">
                    <span title="supprimer cette commande" class="glyphicon glyphicon-remove"></span> </a>
                </td>
            </tr>' ;
}
echo '</tbody></table>';

?>
