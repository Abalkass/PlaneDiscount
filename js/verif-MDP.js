
 $(document).ready(function() {

    $('#pwd, #pwdConfirm').on('keyup', function(e) {

    	if($('#pwd').val() != '' && $('#pwdConfirm').val() != '' && $('#pwd').val() != $('#pwdConfirm').val())
    	{
    		$('#verifPassword').removeClass().addClass('alert alert-error').html('Les mots de passe saisi ne se correspondent pas !');

        	return false;
    	}

        //Doit contenir au moins un chiffre et une majuscule et minuscule ou des caractère spéciaux, et au moins 10 caractères.
        var strongRegex = new RegExp("^(?=.{10,})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W))|((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))).*$", "g");

        // Doit avoir au moins 8 caractères
        var okRegex = new RegExp("(?=.{8,}).*", "g");

        if (okRegex.test($(this).val()) === false) {
            // S'il n'a pas la taille minimum requise
        	$('#verifPassword').removeClass().addClass('alert alert-error').html('Doit avoir au moins 8 caractères !');

        } else if (strongRegex.test($(this).val())) {
            // Si c'est OK
            $('#verifPassword').removeClass().addClass('alert alert-success').html('Mot de passe correct !');

        } else {
            // Si contient que des minuscules et des chiffres
            $('#verifPassword').removeClass().addClass('alert alert-info').html('Mot de passe faible ! Essayer de varier les caractères en utilisant de chiffre, des lettres minuscules et majuscules et des caractères spéciaux.');

        }
        
        return true;
    });

});