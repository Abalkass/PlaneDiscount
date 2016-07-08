
<?php 
	if (isset($messageErreur)) {
		echo '<p class="erreur">
				<span class="glyphicon glyphicon-warning-sign"></span>
				. ' . $messageErreur .'
			</p>';
	}
?>
<form method="POST" action="./index.php?controller=client&amp;action=updatedPWD">
	<fieldset>
		<legend>Mise à jour du mot de pase d'un client :</legend>
        <p>
			<label for="id">Identifiant :</label>
			<input type="text" name="id" value="<?= $id ?>" readonly required/>
		</p>
        <p>
			<label for="mdp">Mot de passe actuel :</label>
			<input type="password" name="pwdOld" pattern="^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[a-z])(?=.*[0-9]))).*$" title="Doit contenir au moins un chiffre et une majuscule et minuscule, et au moins 8 caractères.">
		</p>
        <p>
			<label for="mdp">Nouveau mot de passe :</label>
			<input type="password" name="pwdNew" id="pwd" pattern="^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[a-z])(?=.*[0-9]))).*$" title="Doit contenir au moins un chiffre et une majuscule et minuscule, et au moins 8 caractères.">
		</p>
		<p>
			<label for="mdp">Confirmation du nouveau mot de passe :</label>
			<input type="password" name="pwdConfirm" id="pwdConfirm" pattern="^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[a-z])(?=.*[0-9]))).*$" title="Doit contenir au moins un chiffre et une majuscule et minuscule, et au moins 8 caractères.">
		</p>
		<p><div class="" id="verifPassword"></div></p>
		<p> <input type="submit" class="btn btn-info" value="Enregistrer" /> </p>

	</fieldset> 
</form>

<script src="js/verif-MDP.js"></script>
