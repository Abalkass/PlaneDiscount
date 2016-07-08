<?php
class Session {
    public static function is_client($idClient) {
        return (!empty($_SESSION['idClient']) && ($_SESSION['idClient'] == $idClient));
    }

    public static function is_admin() {
	    return (!empty($_SESSION['admin']) && $_SESSION['admin']);
	}

	public static function is_user() {
		return (!empty($_SESSION['idClient']) || is_admin());
	}
}
?> 