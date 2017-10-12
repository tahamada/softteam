<?php
	include "Autoload.php";
	$message="";
	$codeh="";
	$nom="";
	$nombmois="";
	$mode="Insertion";
	$modeBouton="Creer";
	$modeTypeCodehNom="text";
	$modeTextCodehNom="";
	$mLocation=new LocationManager();
	$mClient=new ClientManager();
	$mHabitation=new HabitationManager();
	$update=null;
	
	//liste de nom de client	
	$ClientArray=$mLocation->lister2();
	$clients="<select name=Nom>";
	foreach($ClientArray as $oClient){
		$nomClient=$oClient->Nom();
		$clients.="<option value='$nomClient'>$nomClient</option>";
	}
	$clients.="</select>";

	//liste de codeh habitation
	$HabitationArray=$mHabitation->lister2();
	$habitations="<select name=Codeh>";	
	foreach($HabitationArray as $oHabitation){
		$codeh=$oHabitation->Codeh();
		$habitations.="<option value='$codeh'>$codeh</option>";
	}
	$habitations.="</select>";

	//Modification
	if(isset($_POST['update'])){
		//changement affichage mode modification
		$mode="Modification";
		$modeBouton="Modifier";
		$modeTypeCodehNom="hidden";	
		//recuperation des données client
		$updateCodehNom=$_POST['listLocation'];
		$modeTextCodehNom=$updateCodehNom;
		$codeh=explode(",",$updateCodehNom)[0];
		$nom=explode(",",$updateCodehNom)[1];
		$updateLocation=$mLocation->lister2(array("Codeh"=>$codeh,"Nom"=>$nom))[0];
		$Codeh=$updateLocation->Codeh();
		$nom=$updateLocation->Nom();
		$nombmois=$updateLocation->NombMois();
		$codeh=explode(",",$updateCodehNom)[0];
		$nom=explode(",",$updateCodehNom)[1];
		$clients="<input type='hidden' name='Nom' value='$nom'/>$nom";		
		$habitations="<input type='hidden' name='Codeh' value='$codeh'/>$codeh";
	}

	
	//enregistrement(modification) du client
	if(isset($_POST["Creer"]) || isset($_POST['Modifier'])){
		if(isset($_POST['Modifier']))
			$update=true;
		$oLocation=new Location($_POST);
		try
		{			
			$mLocation->enregistrer2($oLocation,$update);
		}catch(Exception $e){
			$message.=$e->getMessage()."<br/>";
		}
		if($message=="")
			$message.="Operation reussit";
	}
?>
<?php echo $message?>
<h2><?php echo $mode?> location</h2>
<form action="" method="POST">
	Codeh:<?php echo $habitations?>
	<br/>
	Nom:<?php echo $clients?>
	<br/>
	NombMois:<input type="text" name="NombMois" value="<?php echo $nombmois?>"><br/>
	<input type="submit" name="<?php echo $modeBouton?>" value="<?php echo $modeBouton?>">
</form>
<a href="afficheLocation.php">Liste de location</a><br/>
<a href="insertLocation.php">Ajouter location</a>