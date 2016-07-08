<div class="titre">
    <h2>Produit créé</h2>
    <hr>
</div>
<?php
	echo '<p> IdProduit : ' . $prod->getIdProduit() .
		'<br> Libéllé : ' . $libelle .
		'<br> Type d\'avion : ' . $type .
		'<br> Constructeur : ' . $constructeur .
		'<br> Nombre de place : ' . $dimension.
		'<br> Poids à vide : ' . $poids . ' tonnes' .
		'<br> Vitesse maximal : ' . $vitesse . ' km/h' .
        '<br> Prix unitaire : ' . $prix . ' euros' .
        '<br> Quantité disponible : ' . $qte . 
        '<br> ' . $message . '</p>';
?>

