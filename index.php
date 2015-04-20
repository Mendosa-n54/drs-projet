
<?php include_once './vendor/autoload.php'; ?>
<?php 
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
		'twig.path' => __DIR__.'/../views',
	)); 
	$app->get('/twig/{name}', function ($name) use ($app) {
		return $app['twig']->render('index.twig', array(
			'name' => $name,
		));
	});
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Application Facebook d'envoi d'email simplifié - DRS - Page index</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>



<body>
	<!-- Index du site permettant de rediriger instantanément vers la page d'accueil -->
	<?php header('Location:html/accueil.php');?>
</body>
</html>