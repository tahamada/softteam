<?php
	include "Autoload.php";
	$message="";
	$codeh="";
	$ville="";
	$typeh="";
	$adresse="";
	$loyerm="";
	$mode="Insertion";
	$modeBouton="Creer";
	$modeTypeCodeh="text";
	$modeTextCodeh="";
	$mHabitation=new HabitationManager();
	$update=null;
	//Modification
	if(isset($_POST['update'])){
		//changement affichage mode modification
		$mode="Modification";
		$modeBouton="Modifier";
		$modeTypeCodeh="hidden";		
		//recuperation des données client
		$updateCodeh=$_POST['listHabitation'];
		$modeTextCodeh=$updateCodeh;
		$updateClient=$mHabitation->lister($updateCodeh)[0];
		$Codeh=$updateClient->Codeh();
		$modeTextCodeh=$Codeh;
		$typeh=$updateClient->Typeh();
		$adresse=$updateClient->Adresse();
		$ville=$updateClient->Ville();
		$loyerm=$updateClient->LoyerM();		
	}

	//enregistrement(modification) du client
	if(isset($_POST["Creer"]) || isset($_POST['Modifier'])){
		$oHabitation=new Habitation($_POST);
		if(isset($_POST['Modifier']))
			$update=true;
		try
		{
			$mHabitation->enregistrer2($oHabitation,$update);
		}catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
		}
		$message.="Operation reussit";
	}
?>
<?php echo $message?>
<h2><?php echo $mode?> habitation</h2>
<form action="" method="POST">
	Codeh:<input type="<?php echo $modeTypeCodeh?>" name="Codeh" value='<?php echo $modeTextCodeh?>' >
	<?php echo $modeTextCodeh?><br/>
	Typh:<input type="text" name="Typeh" value="<?php echo $typeh?>"><br/>
	Adresse:<input type="text" name="Adresse" value="<?php echo $adresse?>"><br/>
	Ville:<input type="text" name="Ville" value="<?php echo $ville?>"><br/>
	LoyerM:<input type="text" name="LoyerM" value="<?php echo $loyerm?>"><br/>
	<input type="submit" name="<?php echo $modeBouton?>" value="<?php echo $modeBouton?>">
</form>
<a href="afficheHabitation.php">Liste de habitation</a><br/>
<a href="insertHabitation.php">Ajouter Habitation</a>