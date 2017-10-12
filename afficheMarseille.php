<?php
	include "Autoload.php";
	$message="";
	$non="";
	$mMarseille=new MarseilleManager();

	//suppression des clients
	if(isset($_POST['delete'])){
		$delCodeh=$_POST['listMarseille'];
		$delMarseille=$mMarseille->lister($delCodeh)[0];
		try{
			$mMarseille->supprimer2($delMarseille);			
		}	
		catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
			$non="non";
		}
		$message.="$delCodeh $non supprimé";	

	}


	//listage des clients
	$habitations="";
	$oMarseilleArray=$mMarseille->lister2();
	foreach($oMarseilleArray as $habitation){
		$codeh=$habitation->Codeh();
		//list de client
		$habitations.="<option value='$codeh'>$codeh</option>";
	}
?>
<html>
<head>
	<meta charset="utf-8">
</head>	
<body>
	<?php echo $message;?>
	<h2>Liste des Habitations</h2>
	<form action="" method="POST">
		<select name="listMarseille">
			<?php echo $habitations?>
		</select>		
		<input type='submit' name='delete' value='supprimer'>
		<input type='submit' name='update' formaction="insertMarseille.php" value='Modifier'>
	</form>
	<a href="insertHabitation.php">Ajout Habitation</a>
</body>

</html>