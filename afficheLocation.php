<?php
	include "Autoload.php";
	$message="";
	$non="";
	$mLocation=new LocationManager();

	//suppression des clients
	if(isset($_POST['delete'])){
		$delCodehNom=$_POST['listLocation'];
		$codeh=explode(",",$updateCodehNom)[0];
		$nom=explode(",",$updateCodehNom)[1];
		$delLocation=$mLocation->lister2(array("Codeh"=>$codeh,"Nom"=>$nom))[0];
		try{
			$mLocation->supprimer2($delLocation);			
		}	
		catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
			$non="non";
		}
		$message.="$delCodehNom $non supprimé";	

	}


	//listage des clients
	$locations="";
	$oLocationArray=$mLocation->lister();
	foreach($oLocationArray as $location){
		$codeh=$location->Codeh();
		$nom=$location->Nom();
		//list de client
		$locations.="<option value='$codeh,$nom'>$codeh,$nom</option>";
	}
?>
<html>
<head>
	<meta charset="utf-8">
</head>	
<body>
	<?php echo $message;?>
	<h2>Liste des Locations</h2>
	<form action="" method="POST">
		<select name="listLocation">
			<?php echo $locations?>
		</select>		
		<input type='submit' name='delete' value='supprimer'>
		<input type='submit' name='update' formaction="insertLocation.php" value='Modifier'>
	</form>
	<a href="insertLocation.php">Ajout Location</a>
</body>

</html>