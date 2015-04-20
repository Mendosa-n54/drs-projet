
<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Envoi email simplifié - Formulaire email</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link href="../css/style.css" media="screen" rel="stylesheet" type="text/css">
</head>



<body>
	<div class="body2">
		<!-- Config -->
		<?php include("../config/config.php"); ?>
		<!-- Connexion BDD -->
		<?php include("../sql/connexion_bdd.php"); ?>
		<!-- Header -->
		<?php include("header.php"); ?>



		<!-- Contenu -->
		<div class="contenu">
			<div id="mail">
				<h3>Envoyez un email personnalisé grâce à votre profil Facebook</h3>
				
				<?php if(array_key_exists("erreurs", $_SESSION)): ?>
					<div id="formulaire_erreur">
						<?= implode("</br>", $_SESSION[erreurs]); ?>
					</div>
				<?php unset($_SESSION["erreurs"]); endif; ?>
				
				<form id="formulaire_mail" name="formulaire_mail" method="POST" action="envoie.php">
					<div class="formulaire_mail_element">
						<label for="formulaire_mail_email_destinataire">Adresse email du destinataire</label></br>
						<input type="text" class="saisie" name="formulaire_mail_email_destinataire" id="formulaire_mail_email_destinataire" required></input>
					</div>
						
					<div class="formulaire_mail_element">
						<label for="formulaire_mail_sujet">Sujet du message</label></br>
						<input type="text" class="saisie" name="formulaire_mail_sujet" id="formulaire_mail_sujet" required></input>
					</div>
						
					<div class="formulaire_mail_element">
						<label for="formulaire_mail_message">Message à envoyer</label></br>
						<textarea class="saisie" name="formulaire_mail_message" id="formulaire_mail_message" required></textarea>
					</div>
						
					<input type="submit" class="bouton" value="Envoyer"></input>
				</form>
			</div>
		</div>
	</div>



	<!-- Footer -->
	<?php include("footer.php"); ?>
</body>
</html>