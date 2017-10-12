<?php
	include "Autoload.php";
	$message="";
	$non="";
	$mHabitation=new HabitationManager();

	//suppression des clients
	if(isset($_POST['delete'])){
		$delCodeh=$_POST['listHabitation'];
		$delHabitation=$mHabitation->lister($delCodeh)[0];
		try{
			$mHabitation->supprimer2($delHabitation);			
		}	
		catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
			$non="non";
		}
		$message.="$delCodeh $non supprimé";	

	}


	//listage des clients
	$habitations="";
	$oHabitationtArray=$mHabitation->lister();
	foreach($oHabitationtArray as $habitation){
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
		<select name="listHabitation">
			<?php echo $habitations?>
		</select>		
		<input type='submit' name='delete' value='supprimer'>
		<input type='submit' name='update' formaction="insertHabitation.php" value='Modifier'>
	</form>
	<a href="insertHabitation.php">Ajout Habitation</a>
</body>

</html>