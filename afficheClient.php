<?php
	include "Autoload.php";
	$message="";
	$non="";
	$mClient=new ClientManager();

	//suppression des clients
	if(isset($_POST['delete'])){
		$delNom=$_POST['listClient'];
		$delClient=$mClient->lister($delNom)[0];
		try{
			$mClient->supprimer2($delClient);			
		}	
		catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
			$non="non";
		}
		$message.="$delNom $non supprimé";	

	}

	//listage des clients
	$clients="";
	$oClientArray=$mClient->lister();
	foreach($oClientArray as $client){
		$nom=$client->Nom();
		
		//list de client
		$clients.="<option value='$nom'>$nom</option>";
	}
?>
<html>
<head>
	<meta charset="utf-8">
</head>	
<body>
	<?php echo $message;?>
	<h2>Liste des Clients</h2>
	<form action="" method="POST">
		<select name="listClient">
			<?php echo $clients?>
		</select>		
		<input type='submit' name='delete' value='supprimer'>
		<input type='submit' name='update' formaction="insertClient.php" value='Modifier'>
	</form>
	
	<a href="insertClient.php">Ajout Client</a>
</body>

</html>