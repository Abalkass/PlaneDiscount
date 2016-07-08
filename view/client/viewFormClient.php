<?php
	if ($action=="create")
		{echo '<form class="edition" method="POST" action="./index.php?controller=client&amp;action=created">
		<fieldset>
			<legend class="titre-legend">Création d’un nouveau client</legend>';}
	elseif ($action=="update")
		{echo '<form method="POST" action="./index.php?controller=client&amp;action=updated">
		<fieldset>
			<legend class="titre-legend">Mise à jour  d\'un client</legend>
			<input type="hidden" name="id" value="' . $id . '" readonly required/>
		';}
?>

		<p class="form-group">
			<label>Nom :</label>
			<input class="form-control" type="text" name="nom" value="<?php if ($action=="update") echo $nom ?>" maxlength="32" size="32" pattern="[A-Za-z0-9\u00C0-\u00FF\u0020\u002D].{1,}" required/>
		</p>
		<p class="form-group">
			<label>Prenom :</label>
			<input class="form-control" type="text" name="prenom" value="<?php if ($action=="update") echo $prenom ?>" maxlength="32" size="32" pattern="[A-Za-z0-9\u00C0-\u00FF\u0020\u002D].{1,}" required/>
		</p>
		<p class="form-group">
			<label>Email :</label>
			<input class="form-control" type="email" name="email" value="<?php if ($action=="update") echo $email ?>" maxlength="32" size="32" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="exemple@mail.net avec seulement des minuscules et des chiffres" required/>
		</p>
	<?php if ($action=="create") echo '
		<p class="form-group">
			<label>Mot de passe :</label>
			<input class="form-control" type="password" name="pwd" id="pwd" pattern="^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[a-z])(?=.*[0-9]))).*$" title="Doit contenir au moins un chiffre et une majuscule et minuscule, et au moins 8 caractères.">
		</p>
		<p class="form-group">
			<label>Confirmation mot de passe :</label>
			<input class="form-control" type="password" name="pwdConfirm" id="pwdConfirm" pattern="^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[a-z])(?=.*[0-9]))).*$" title="Doit contenir au moins un chiffre et une majuscule et minuscule, et au moins 8 caractères.">
		</p>
		<div class="form-group" id="verifPassword"></div>
	'; ?>
		<p class="form-group">
			<label>Adresse :</label>
			<input class="form-control" type="text" name="adresse" value="<?php if ($action=="update") echo $adresse ?>" maxlength="150" size="32" required/>
		</p>
		<p class="form-group">
			<label>Code Postal :</label>
			<input class="form-control" type="text" name="cp" value="<?php if ($action=="update") echo $cp ?>" maxlength="5" size="5" pattern="\d{5}" title="Obligatoirement 5 chiffres !" required/>
		</p>
		<p class="form-group">
			<label>Ville :</label>
			<input class="form-control" type="text" name="ville" value="<?php if ($action=="update") echo $ville ?>" maxlength="32" size="32" pattern="[A-Za-z0-9\u00C0-\u00FF\u0020\u002D].{1,}" required/>
		</p>
		<p class="form-group">
			<label>Téléphone :</label>
			<input class="form-control" type="text" name="tel" value="<?php if ($action=="update") echo $tel ?>" maxlength="10" size="10" pattern="\d{10}" title="Obligatoirement 10 chiffres" required/>
		</p>
	<?php if (Session::is_admin() && $action=="update") echo '
		<p class="form-group">
			<label>Administrateur ? </label>
			<input type="checkbox" name="admin" />
		</p>';
	?>

		<p class="form-group"> <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enregistrer" />	</p>

	</fieldset> 
</form>

<script src="js/verif-MDP.js"></script>
