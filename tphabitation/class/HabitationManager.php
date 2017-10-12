<?php

Class HabitationManager extends Manager{
	public function __construct()
	{
		parent::__construct();
	}

	//liste des habitations ou recherche d'un habitation
	public function lister($value=null){
		$arrayexecute=[];
		$HabitationArray=[];
		if($value==null)
			$req=$this->Bdd()->prepare("select * from habitation");
		else{
			$req=$this->Bdd()->prepare("select * from habitation where codeh=:codeh");
			$arrayexecute=array(
				"codeh"=>$value
			);
		}

		$req->execute($arrayexecute);
		while($row=$req->fetch(PDO::FETCH_ASSOC)){
			$HabitationArray[]=new Habitation($row);
			//$p->afficher();
		}
		return $HabitationArray;
	}


	public function enregistrer($habitation,$update=null){
		if($update==null){
			$req=$this->Bdd()->prepare("INSERT INTO habitation values(:Codeh,:typeh,:adresse,:ville,:loyerm)");
		}		
		else{
			$req=$this->Bdd()->prepare("UPDATE habitation SET typeh=:typeh,Adresse=:adresse,Ville=:ville,LoyerM=:loyerm WHERE Codeh=:Codeh");
		}
		$req->execute(array(
			"Codeh"=>$habitation->Codeh(),
			"typeh"=>$habitation->Ville(),
			"adresse"=>$habitation->Adresse(),
			"ville"=>$habitation->Ville(),
			"loyerm"=>$habitation->LoyerM(),
		));
	}


	public function supprimer($habitation){
		$req=$this->Bdd()->prepare("DELETE from habitation WHERE Codeh='".$habitation->Codeh()."'");
		$req->execute();
	}	
}
?>