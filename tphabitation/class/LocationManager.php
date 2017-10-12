<?php

Class LocationManager extends Manager{
	public function __construct()
	{
		parent::__construct();
	}

	//liste des locations ou recherche d'un location
	public function lister($value=null){
		$arrayexecute=[];
		$LocationArray=[];
		if($value==null)
			$req=$this->Bdd()->prepare("select * from location");
		else{
			$codeh=$value[0];
			$nom=$value[1];
			$req=$this->Bdd()->prepare("select * from location where Codeh=:codeh and Nom=:nom");
			$arrayexecute=array(
				"codeh"=>$codeh,
				"nom"=>$nom
			);
		}

		$req->execute($arrayexecute);
		while($row=$req->fetch(PDO::FETCH_ASSOC)){
			$LocationArray[]=new Location($row);
			//$p->afficher();
		}
		return $LocationArray;
	}


	public function enregistrer($location,$update=null){
		if($update==null){
			$req=$this->Bdd()->prepare("INSERT INTO location values(:codeh,:nom,:nombmois)");
		}		
		else{
			$req=$this->Bdd()->prepare("UPDATE location SET NombMois=:nombmois WHERE Codeh=:codeh and nom=:nom");
		}
		$req->execute(array(
			"codeh"=>$location->Codeh(),
			"nom"=>$location->Nom(),
			"nombmois"=>$location->NombMois()
		));
	}

	public function supprimer($location){
		$req=$this->Bdd()->prepare("DELETE from location WHERE Codeh='".$location->Codeh()."'");
		$req->execute();
	}	
}
?>