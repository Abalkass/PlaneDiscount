<?php
$id = $prod->getIdProduit();
$libelle=$prod->getLibelle();

echo '
<div class="panel panel-primary">
	<div class="panel-heading"><h2>' . $prod->getLibelle() . '</h2></div>
	<div class="panel-body">

		<div class="row">
	  		<div class="col-sm-4">';
		if (file_exists("$DIR_IMG_PROD{$DS}$id-$libelle.jpg"))   // si l'image du produit existe
			echo '<img src="images/produit/'.$prod->getIdProduit(). '.jpg" class="img-thumbnail" alt="image produit">';
		else
			echo '<img src="images/image-not-found.gif" class="img-thumbnail" alt="image produit">';

echo '
			</div>	<!-- Fin col-sm-4 -->

			<div class="col-sm-8">
				<p> IdProduit : ' . $prod->getIdProduit() .
				'<br> Libéllé : ' . $prod->getLibelle() .
				'<br> Type d\'avion : ' . $prod->getTypeAvion() .
				'<br> Constructeur : ' . $prod->getConstructeur() .
				'<br> Nombre de place : ' . $prod->getDimension() .
				'<br> Poids à vide : ' . $prod->getPoidsAVide() . ' tonnes' .
				'<br> Vitesse maximal : ' . $prod->getVitesseMax() . ' km/h' .
		        '<br> Prix unitaire : ' . $prod->getPrixUnitaire() . ' euros' .
		        '<br> Quantité disponible : ' . $prod->getQteDispo() . '</p>
		    </div>	<!-- Fin col-sm-8 -->
		</div>	<!-- Fin row-->';

	if (!Session::is_admin()) echo '
		<div class="row">
			<div class="col-sm-2 col-sm-push-5">
				<a class="btn btn-lg btn-primary" href="index.php?controller=panier&amp;action=ajout&amp;id='.$prod->getIdProduit() .'" role="button">Ajouter au panier</a>
			</div>	<!-- Fin col-sm-8 -->
		</div>	<!-- Fin row-->';
echo '
	</div>	<!-- Fin panel-body-->
</div>	<!-- Fin panel-->';



if (Session::is_admin()) {

	echo '<p> Si vous voulez modifier les informations de ce produit, <a href="index.php?controller=produit&amp;action=update&amp;id=' . $prod->getIdProduit() . '"> cliquez-ici !</a> </p>';

	echo '<p> Si vous voulez suppprimer ce produit, <a href="index.php?controller=produit&amp;action=delete&amp;id=' . $prod->getIdProduit() . '"> cliquez-ici !</a> </p>';
}
?>