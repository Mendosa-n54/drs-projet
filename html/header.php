
<div id="header">
	<div id="header_accueil">
		<a href="accueil.php"><input type="button" value="Accueil" class="bouton"/></a>
	</div>



	<div id="header_connexion">
		<?php
			// Code a exécuter une seule et unique fois. Mettre en commentaire après son exécution
			/*FB.ui(
			{
				method: 'pagetab',
				redirect_uri: 'YOUR_URL'
			}, function(response){});*/

			// Uses ...
			use Facebook\FacebookSession;
			use Facebook\FacebookRedirectLoginHelper;
			use Facebook\FacebookRequest;
			use Facebook\FacebookRequestException;
			use Facebook\GraphUser;
			
			// Initialisation du SDK
			FacebookSession::setDefaultApplication($appId, $appSecret);
			
			$helper = new FacebookRedirectLoginHelper($redirectUrl);

			// Affichage du contenu de $permissions
			//echo $loginUrl; 
			
			try
			{
				$session = $helper->getSessionFromRedirect();
			} 
			catch(FacebookRequestException $ex)
			{
				echo $ex;
			} 
			//catch(\Exception $ex)
			catch(Exception $ex)
			{
				echo $ex;
			}

			// Traitement de la session
			// Test si la session existe
			if(isset($_SESSION['token']))
			{
				// Test si le token est correct
				$session = new FacebookSession($_SESSION['token']);
				try
				{
					$session->Validate($appId ,$appSecret);
				}
				catch( FacebookAuthorizationException $ex)
				{
					// Session invalide. Reinitialisation
					$session ='';
				}
			}
			// Test si la session existe
			if (isset($session))
			{
				// Affectation du token de la session PHP dans le token de la session actuelle
				$_SESSION['token'] = $session->getToken();
				//$_SESSION['token'] = (string) $session->getAccessToken();
			}
			
			// Récupération des informations du profil
			if($session)
			{
				$user_profile = (new FacebookRequest($session,'GET','/me'))->execute()->getGraphObject(Facebook\GraphUser::className());
				
				$id = $user_profile->getId();
				$prenom = $user_profile->getfirstName();
				$nom = $user_profile->getlastName();
				$sexe = $user_profile->getProperty('gender'); 
				$email = $user_profile->getProperty('email');
				$anniversaire = $user_profile->getProperty('birthday');
				$biographie = $user_profile->getProperty('about_me');
				//$photo = $user_profile->getProperty('picture');
				
				if($sexe == "male")
				{
					$sexe = "Homme";
				}
				else
				{
					$sexe = "Femme";
				}
				
				// Insertion des informations de l'utilisateur dans la BDD 'drs'
				// Traitement des données avec SQLite3
				try
				{
					// Ouverture de la base de données
					$bdd_ouverture = new PDO('sqlite:drs.sqlite');
					// Création de la base de données
					//$bdd_ouverture->exec("CREATE TABLE utilisateur (id INTEGER PRIMARY KEY NOT NULL, prenom TEXT, nom TEXT, sexe TEXT, email TEXT, anniversaire TEXT, biographie TEXT)");
					// Test si l'utilisateur est déjà inscrit dans la base de données
					$utilisateur_courant = $bdd_ouverture->exec("SELECT id FROM utilisateur");
					if($utilisateur_courant == 0)
					{
						// Membre pas encore inscrit. Insertion des infromations dans la base de données
						$bdd_ouverture->exec("INSERT INTO utilisateur (id, prenom, nom, sexe, email, anniversaire, biographie) VALUES ('$id', '$prenom', '$nom', '$sexe', '$email', '$anniversaire', '$biographie');");
					}
					else
					{
						// Membre déjà inscrit. Pas d'insertion dans la base de données
					}
 
					// Affichage des données
					/*$resultat = $bdd_ouverture->query('SELECT * FROM utilisateur');
					foreach($resultat as $ligne)
					{
						print "id : ".$ligne['id']."";
						print "prenom : ".$ligne['prenom']."";
						print "nom : ".$ligne['nom']."";
						print "sexe : ".$ligne['sexe']."";
						print "email : ".$ligne['email']."";
						print "anniversaire : ".$ligne['anniversaire']."";
						print "biographie : ".$ligne['biographie']."";
					}*/
					
					// Fermeture de la connexion à la base de données
					$bdd_ouverture = NULL;
				}
				catch(PDOException $e)
				{
					print 'Exception : '.$e->getMessage();
				}

				// Traitement de la base de données avec MySQL
				/*$requete_test = "SELECT id FROM utilisateur WHERE id = '$id'";
				$resultat_test =  mysqli_query($bdd_ouverture, $requete_test);
				$ligne = mysqli_fetch_array($resultat_test, MYSQLI_ASSOC);
				// Vérification si l'utilisateur est déjà inscrit		
				if(mysqli_num_rows($resultat_test) != 0)
				{
					//echo "Inscription déjà réalisée !";
					die();
				}
				else
				{
					$requete_insert = "INSERT INTO utilisateur(id,prenom,nom,sexe,email,anniversaire,biographie) VALUES ('$id','$prenom','$nom','$sexe','$email','$anniversaire','$biographie')";
					//$requete_insert = "INSERT INTO utilisateur(id,prenom,nom,sexe,email,anniversaire,biographie) VALUES ("'.$id.'","'.$prenom.'","'.$nom.'","'.$sexe.'","'.$email.'","'.$anniversaire.'","'.$biographie.'")";
					//$resultat_insert = $bdd_nom->exec($requete_insert);
					$resultat_insert = mysqli_query($bdd_ouverture, $requete_insert);
				}
				$mysqli->close();*/
				
				$next = "";
				$logoutUrl = $helper->getLogoutUrl($session, $next);
				echo '<a href="'.$logoutUrl.'"><input type="button" class="bouton" value="Quitter l\'application"></a>';
				/*?><a href="<?php echo $logoutUrl; ?>">Déconnexion</a><?php*/
				echo '<a href="deconnexion.php"><input type="button" class="bouton" value="Déconnexion"></a>';
			}
			else
			{
				//$loginUrl = $helper->getLoginUrl();
				$loginUrl = $helper->getLoginUrl($permissions);
				/*?><a href="<?php echo $loginUrl;?>"><input type="button" value="Connexion Facebook" class="bouton"/></a><?php*/
				echo '<a href="'.$loginUrl.'"><input type="button" class="bouton" value="Connexion Facebook"></a>';
			}
		?>
	</div>
	<hr>
</div>