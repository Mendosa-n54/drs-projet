
<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Application Facebook d'envoi d'email simplifié - DRS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link href="../css/style.css" media="screen" rel="stylesheet" type="text/css" >
	<script>
		window.fbAsyncInit = function()
		{
			FB.init(
			{
				appId      : '627623190704757',
				xfbml      : true,
				version    : 'v2.2'
			});
		};

		(function(d, s, id)
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = '//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.3&appId=627623190704757';
			fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
		
		// Code a exécuter une seule et unique fois. Mettre en commentaire après son exécution
		/*FB.ui({
			method: 'pagetab',
			//redirect_uri: 'YOUR_URL'
			redirect_uri: 'https://drs-projet.fr.gp/html/accueil.php'
		}, function(response){});*/
	</script>
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
				if($session)
				{
					echo 'Bonjour '.$prenom.' !</br>';
					echo "<img src='https://graph.facebook.com/".$id."/picture?type=normal'/></br></br>";

					echo 'Voici vos informations Facebook : </br>';
					/*echo '- '.$id.'</br>';*/
					echo '- '.$prenom.'</br>';
					echo '- '.$nom.'</br>';
					echo '- '.$sexe.'</br>';
					echo '- '.$email.'</br>';
					echo '- '.$anniversaire.'</br></br>';
					if($biographie!="")
					{
						echo '- '.$biographie.'</br></br>';
					}
					/*if($photo!="")
					{
						echo "<img src='".$photo['data']['url']."'/>";
						echo '</br></br>';
					}
					else
					{
						echo "Pas de photo de profil ... </br></br>";
					}*/
					
					echo "Vous pouvez à présent utiliser la fonctionnalité d'envoi de mail simplifié. Cliquez sur le bouton ci dessous</br></br>";
					echo "<a href='mail.php'><input type='button' class='bouton' value='Envoyer un email'></a></br></br></br>";
					
					echo "Pensez également à liker et à partager cette application : </br>";
					echo "<div class='fb-like' data-show='true' data-wids='450' data-show-faces='true' width='250px'></div></br>";
					echo "<div id='fb-root'></div>";
					echo "<div class='fb-share-button' data-href='accueil.php' data-layout='button_count'></div></br>";
				}
				else
				{
					echo 'Veuillez vous identifier en cliquant sur le bouton \'Connexion Facebook\' s\'il vous plait';
				}
			?>
		</div>
	</div>
	
	
	
	<!-- Footer -->
	<?php include("footer.php"); ?>
</body>
</html>