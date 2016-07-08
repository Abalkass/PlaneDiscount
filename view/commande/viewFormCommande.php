<?php
	if ($action=="create")
		{echo '<form class="edition" method="POST" action="./index.php?controller=commande&amp;action=created">
		<fieldset>
          <legend class="titre-legend">Création d’une nouvelle commande :</legend>';}
	elseif ($action=="update")
		{echo '<form method="POST" action="./index.php?controller=commande&amp;action=updated">
		<fieldset>
          <legend class="titre-legend">Mise à jour  d\'une commande :</legend>
			<input type="hidden" name="id" value="' . $id . '" size="32" readonly required/>
        ';}
?>
		<p class="form-group">
			<label>Identifiant du client : </label>
            <select class="form-control" name="id_cli">
                <?php
                    if ($action=="update")
                        echo '<option value="' . $id_cli . '" selected>' . $id_cli . '</option>';
                
                    //affiche un menu déroulant avec la liste des id clients 
                    foreach ($tab_cli as $cli) {
                        echo '<option value="' . $cli->getIdClient() . '">' . $cli->getIdClient() . '</option>';
                    }
                ?>
            </select>
		</p>

<?php 
    if ($action=="update"){ echo '
		<p class="form-group">
			<label>Date de la commande : </label>
            <input class="form-control" type="text" class="form-control" name="date" value="' . $date . '" required/>
		</p>
		<p class="form-group">
			<label>Etat de la commande :</label>
            <select class="form-control" name="etat">
                <option value="' . $etat . '" selected>' . $etat . '</option>
                <option value="En attente de cofirmation">En attente de cofirmation</option>
                <option value="En préparation">En préparation</option>
                <option value="Expédiée">Expédiée</option>
                <option value="Livrée">Livrée</option>
            </select>
        </p>';
    }
?>
		<p class="form-group"> <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enregistrer" />	</p>

	</fieldset> 
</form>


<script type="text/javascript">
    /* Script jquery pour afficher un mini calendrier */ 
    $('#sandbox-container input').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "fr",
        autoclose: true
    });
</script>
