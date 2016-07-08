<div class="row">
	<div class="col-sm-12">
		<h2>Connexions à votre compte</h2>
		<div class="row">
			<div class="col-sm-6">
				<h4>Identifier vous pour poursuivre</h4>
				<hr>
				<?php 
					if (isset($messageErreur)) {
						echo '<p class="erreur">
								<span class="glyphicon glyphicon-warning-sign"></span>
								. ' . $messageErreur .'
							</p>';
					}
				?>
				<form method="POST" action="index.php?controller=client&amp;action=connected" class="form" >
					<div class="form-group form-inline">
						<label>Email : </label>
						<input type="email" class="form-control login-field" name="email" placeholder="exemple@mail.net" required/>
						<label class="login-field-icon fui-user"></label>
					</div>

					<div class="form-group form-inline">
						<label>Mot de passe : </label>
						<input type="password" class="form-control login-field" name="pwd" placeholder="Mot de passe" required/>
						<label class="login-field-icon fui-lock"></label>
					</div>

					<input type="submit" class="btn btn-primary btn-lg btn-block" value="Connexion"> 
					<hr>
					<p><a class="login-link" href="#">Mot de passe oublié?</a></p>
				</form>
			</div>
			<div class="col-sm-6">
				<h4>Vous êtes un nouveau client de PlaneDiscount</h4>
				<hr>
				<p>Inscrivez-vous pour profiter de nos offres et ses services.</p>
				<p> <a class="btn btn-lg btn-primary btn-block" href="index.php?controller=client&amp;action=create" role="button">Créer un compte</a></p>
			</div>
		</div>
	</div>
</div>
