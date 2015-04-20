
<?php
	session_start();
	
	unset($_SESSION);
	unset($_COOKIE);
	session_unset(); 
	session_destroy();
	
	//$_SESSION["id"] = NULL;

	header("location:accueil.php");

	/*if(!isset($_SESSION['pseudo_membre']) && empty($_SESSION['pseudo_membre']))
	{
		echo 1;
	}
	else
	{
		echo 0;
	}*/
?>