<?php
	if ($action=="create")
		{echo '<form method="POST" action="./index.php?controller=produit&action=created" enctype="multipart/form-data">
		<fieldset>
		<legend class="titre-legend">Création d’un nouveau produit</legend>';}
	elseif ($action=="update")
		{echo '<form method="POST" action="./index.php?controller=produit&action=updated" enctype="multipart/form-data">
		<fieldset>
		<legend class="titre-legend">Mise à jour d\'un produit</legend>
			<input type="hidden" name="id" value="' . $id . '" readonly required/>
		';}
?>
		<p class="form-group">
			<label>Libéllé :</label>
			<input class="form-control" type="text" name="libelle" value="<?php if ($action=="update") echo $libelle ?>" maxlength="32" size="32" pattern="[A-Za-z0-9\u00C0-\u00FF\u0020\u002D].{1,}" required/>
		</p>
		<p class="form-group">
			<label>Type d'avion :</label>
            <select class="form-control" name="type">
                <option value="Avions de ligne">Avion de ligne</option>
                <option value="Avion-Cargo">Avion-Cargo</option>
                <option value="Avions d'affaire">Avion d'affaire</option>
                <option value="Avions légers">Avion léger</option>
                <option value="ULM">ULM</option>
                <option value="Avions de chasse">Avions de chasse</option>
                <option value="Avions de transport militaire">Avion de transport militaire</option>
                <option value="Avions de reconnaissance">Avion de reconnaissance</option>
                <option value="Hélicoptères civils">Hélicoptère civils</option>
                <option value="Hélicoptères militaires">Hélicoptère militaire</option>
                <option value="Hélicoptères de secourisme">Hélicoptère de secourisme</option>
                <?php if ($action=="update") 
                    echo ' <option value="' . $type . '" selected>' . $type . '</option>';
                ?>
            </select>
            
		</p>
		<p class="form-group">
			<label>Constructeur :</label>
			<input class="form-control" type="text" name="constructeur" value="<?php if ($action=="update") echo $constructeur ?>" maxlength="32" size="32" pattern="[A-Za-z0-9\u00C0-\u00FF\u0020\u002D].{1,}" />
		</p>
		<?php 
				if (isset($errorUpload)) {
					echo '<p class="erreur">
							<span class="glyphicon glyphicon-warning-sign"></span>
							. ' . $errorUpload .'
						</p>';
				}
		?>
        <p class="form-group form-inline">
			<label>Image de l'avion :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo TAILLE_MAX; ?>" />
			<input class="form-control" type="file" name="image" />
		</p>
		<p class="form-group">
			<label>Nombre de place :</label>
			<input class="form-control" type="number" name="place" value="<?php if ($action=="update") echo $place ?>" maxlength="10" size="32" />
		</p>
		<p class="form-group">
			<label>Dimension :</label>
			<input class="form-control" type="text" name="dimension" value="<?php if ($action=="update") echo $dimension ?>" maxlength="11" size="32" pattern="[0-9]{1,}x[0-9]{1,}x[0-9]{1,}" title="LongueurxEnvergurexHauteur" />
		</p>
		<p class="form-group">
			<label>Poids à vide :</label>
			<input class="form-control" type="number" name="poids" value="<?php if ($action=="update") echo $poids ?>" maxlength="10" size="32" />
		</p>
        <p class="form-group">
			<label>Vitesse maximal :</label>
			<input class="form-control" type="number" name="vitesse" value="<?php if ($action=="update") echo $vitesse ?>" maxlength="10" size="32" />
		</p>
        <p class="form-group">
			<label>Prix unitaire :</label>
			<input class="form-control" type="text" name="prix" value="<?php if ($action=="update") echo $prix ?>" maxlength="10" size="32"  pattern="([0-9]{1,}|([0-9]{1,},[0-9]{1,}))" title="un nombre à virgule" required/>
		</p>
        <p class="form-group">
			<label>Quantité disponible :</label>
			<input class="form-control" type="number" name="qte" value="<?php if ($action=="update") echo $qte ?>" maxlength="10" size="32" required/>
		</p>
		<p class="form-group"> <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enregistrer" />	</p>

	</fieldset> 
</form>