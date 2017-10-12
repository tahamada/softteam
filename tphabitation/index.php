<?php
	include "Autoload.php";
	$m=new ClientManager();
	$c=new Client(array("Nom"=>"test","VilleResid"=>"test","Profession"=>"test"));
	$m->enregistrer2($c,true);
	$m->supprimer2($c);
?>

<a href="accueilClient.php">Accueil Client</a><br/>
<a href="accueilHabitation.php">Accueil Habitation</a><br/>
<a href="accueilLocation.php">Accueil Location</a><br/>