
<?php
	// Paramètres de l'application
	$appId = '627623190704757';
	$appSecret = '5532f80fc6f0555a7f889fb05409ffd4';
	//$redirectUrl = 'http://localhost/TP/DRS/drs-projet/html/accueil.php';
	$redirectUrl = 'https://drs-projet.herokuapp.com/html/accueil.php';

	// Permissions de l'application
	$permissions = array ('email', 'user_birthday', 'user_about_me', 'user_photos');
	
	// Autoload the required files
	require_once( 'facebook-php-sdk-v4-4.0-dev/autoload.php' );
?>