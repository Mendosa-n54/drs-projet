
<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Envoi email simplifié - Page d'envoie</title>
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
			<?php
				//var_dump($_POST);
				
				$erreurs = [];
				
				if(!array_key_exists("formulaire_mail_email_destinataire", $_POST) || $_POST["formulaire_mail_email_destinataire"] == "" || !filter_var($_POST["formulaire_mail_email_destinataire"], FILTER_VALIDATE_EMAIL))
				{
					$erreurs["formulaire_mail_email_destinataire"] = "Adresse email du destinataire invalide";
				}
				
				if(!empty($erreurs))
				{
					$_SESSION["erreurs"] = $erreurs;
					header("Location: mail.php");
				}
				else
				{
					$destinataire = $_POST["formulaire_mail_email_destinataire"];
					$sujet = $_POST["formulaire_mail_sujet"];
					$message = $_POST["formulaire_mail_message"];
					// Les headers (paramètre n°4) sont des arguments 'bonus' pouvant être envoyés par la fonctionnalité php mail()
					$headers = "FROM: ".$prenom." ".$nom." (".$email.")";
					
					// Ajout des informations Facebook en signature
					$message .= "</br></br>";
					$message .= "".$prenom." ".$nom." (".$email.")";
					$message .= "</br></br>";
					if($biographie != "")
					{
						$message .= "<style='width:40%; float:left; font-style:italic;'>".$biographie."</style>";
						$message .= "<style='width:40%; float:right;'><img src='https://graph.facebook.com/".$id."/picture?type=normal'/></style></br>";
						$message .= $anniversaire;
					}
					else
					{
						$message .= "<img src='https://graph.facebook.com/".$id."/picture?type=normal'/></br>";
						$message .= $anniversaire;
					}
					
					//mail($destinataire, $sujet, $message, $headers);
					echo $headers;
					echo "</br></br>";
					echo $sujet;
					echo "</br></br>";
					echo "<style='text-align:left;'>".$message."</style>";
				}
			?>
		</div>
	</div>



	<!-- Footer -->
	<?php include("footer.php"); ?>
</body>
</html>