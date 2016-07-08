<div class="titre">
    <h1>Votre Panier</h1>
    <hr>
</div>
<?php 
    if (isset($messageErreur)) {
        echo '<p class="erreur">
                <span class="glyphicon glyphicon-warning-sign"></span>
                . ' . $messageErreur .'
            </p>';
    }

    if (creationPanier()) {
        $nbArticles=count($_SESSION['panier']['idProduit']);
        if ($nbArticles <= 0)
            echo '<p class="annonce">Votre panier est vide </p>';
        else {
?>
            <form method="post" action="index.php?controller=panier">
            <table class="table table-condensed">
                <thead> <tr>
                    <th>Libéllé du produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Supprimé article</th>
                </tr> </thead>
                <tbody>
<?php                 
                for ($i=0 ; $i < $nbArticles ; $i++) {
                    $article = ModelProduit::getProduitById($_SESSION['panier']['idProduit'][$i]);
                    $qteEnStock=$article->getQteDispo();
                    echo
                     '<tr>
                        <td>' . htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) . '</td>     <!--colonne des libéllés-->
                        <td> <input type="number" size="2" name="qte[]" value="' . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . '"/> </td>   <!--colonne des quantités-->
                        <td>' . number_format(floatval($_SESSION['panier']['prixProduit'][$i]), 2, ',', ' ') . '</td>        <!--colonne des prix-->
                        <td>
                            <a href="index.php?controller=panier&amp;action=suppression&amp;id=' . rawurlencode($_SESSION['panier']['idProduit'][$i]). '">
                            <span title="supprimer cet article du panier" class="glyphicon glyphicon-trash"></span></a>
                        </td>   <!--colonne de la suppression-->
                    </tr>';
                }
 ?>           
                <tbody>
            </table>
                
            <div class="panel panel-danger">
                <div class="panel-body total-panier">
                    <h4>Prix total : <?php echo number_format(montantGlobal(), 2, ',', ' '); ?> euros</h4>
                </div>
            </div>
            <p>
            <input type="submit" value="Rafraichir" class="btn btn-primary"/>
            <input type="hidden" name="action" value="rafraichir"/>

            <a class="btn btn-primary" href="index.php?controller=panier&amp;action=validation" role="button" style="float:right;">Payer</a>
            </p>
            </form>
<?php 
        
        }   //fin du ELSE
    }//fin de la création de panier
    /*                        <td> <select name="qte[]">' . 
                              '<option value="' . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . ' selected">' . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . '</option>'; 
                               for ($n=0 ; $n <= $qteEnStock ; $n++) {
                               echo '<option value="' . $n . '">' . $n . '</option>';
                               }
                       echo '</select> </td>*/
?>