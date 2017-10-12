<?php
	include "Autoload.php";
	$message="";
	$nom="";
	$ville="";
	$profession="";
	$mode="Insertion";
	$modeBouton="Creer";
	$modeTypeNom="text";
	$modeTextNom="";
	$mClient=new ClientManager();
	$update=null;

	//Modification
	if(isset($_POST['update'])){
		//changement affichage mode modification
		$mode="Modification";
		$modeBouton="Modifier";
		$modeTypeNom="hidden";		
		//recuperation des données client
		$updateNom=$_POST['listClient'];
		$modeTextNom=$updateNom;
		$updateClient=$mClient->lister($updateNom)[0];
		$nom=$updateClient->Nom();
		$modeTextNom=$nom;
		$ville=$updateClient->VilleResid();
		$profession=$updateClient->Profession();
		
	}

	//enregistrement(modification) du client
	if(isset($_POST["Creer"]) || isset($_POST['Modifier'])){
		$oClient=new Client($_POST);
		if(isset($_POST['Modifier']))
			$update=true;
		try
		{		
			$mClient->enregistrer2($oClient,$update);
		}catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
		}
		$message.="Operation reussit";
	}
?>
<?php echo $message?>
<h2><?php echo $mode?> client</h2>
<form action="" method="POST">
	Nom:<input type="<?php echo $modeTypeNom?>" name="Nom" value="<?php echo $nom?>">
	<?php echo $modeTextNom?><br/>
	Ville:<input type="text" name="VilleResid" value="<?php echo $ville?>"><br/>
	Profession:<input type="text" name="Profession" value="<?php echo $profession?>"><br/>
	<input type="submit" name="<?php echo $modeBouton?>" value="<?php echo $modeBouton?>">
</form>
<a href="afficheClient.php">Liste de client</a><br/>
<a href="insertClient.php">Ajouter Client</a>