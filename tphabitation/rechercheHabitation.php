<?php
	include "Autoload.php";
	$mHabitation=new HabitationManager(); 


	$recherche=null;
	$column=[];
	
	//liste de Codeh
	$codehlist=$mHabitation->lister2(null,array("codeh"));
	$codehOptions="<option value=''></option>";
	foreach($codehlist as $habitationCodeh){
		$codehOptions.="<option value='".$habitationCodeh->Codeh()."'>".$habitationCodeh->Codeh()."</option>";
	}

	//liste de Typeh
	$typehlist=$mHabitation->lister2(null,array("typeh"));
	$typehOptions="<option value=''></option>";
	foreach($typehlist as $habitationTypeh){
		$typehOptions.="<option value='".$habitationTypeh->Typeh()."'>".$habitationTypeh->Typeh()."</option>";
	}


	//liste de Ville
	$villelist=$mHabitation->lister2(null,array("ville"));
	$villeOptions="<option value=''></option>";
	foreach($villelist as $habitationVille){
		$villeOptions.="<option value='".$habitationVille->ville()."'>".$habitationVille->ville()."</option>";
	}

	if(isset($_POST['rechercher'])){
		$recherche=[];
		foreach($_POST as $key=>$value){
			if($key!="rechercher" && $value!=""){
				if($key=="prixMin"){
					$recherche['LoyerM']=">".$value;
				}
				elseif($key=="prixMax"){
					$recherche['LoyerM_']="<".$value;
				}
				else
					$recherche[$key]=$value;
			}
		}
	}

	$ligne="";

	$habitationArray=$mHabitation->lister2($recherche,$column);
	foreach($habitationArray as $habitation){
		$ligne.="<tr>";
		$ligne.="<td>".$habitation->Codeh()."</td>";
		$ligne.="<td>".$habitation->Typeh()."</td>";
		$ligne.="<td>".$habitation->Adresse()."</td>";
		$ligne.="<td>".$habitation->Ville()."</td>";
		$ligne.="<td>".$habitation->LoyerM()."</td>";
		$ligne.="</tr>";
	}

?>
<h2>Recherche Habitation</h2>
<form action="" method="POST">
	Codeh:<select name="Codeh">
		<?php echo $codehOptions?>
	</select>
	Typh:<select name="Typeh">
		<?php echo $typehOptions?>
	</select><br/>
	Adresse:<input type="text" name="Adresse">
	Ville:<select name="Ville">
		<?php echo $villeOptions?>
	</select><br/>
	prixMin:<input type="text" name="prixMin">
	prixMax:<input type="text" name="prixMax">
	<input type="submit" name="rechercher" value="rechercher"/>
</form>

<table>
	<tr><th>Codeh</th><th>Typh</th><th>Adresse</th><th>Ville</th><th>Prix</th></tr>
	<?php echo $ligne?>
</table>