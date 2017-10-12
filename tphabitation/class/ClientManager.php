<?php

Class ClientManager extends Manager{
	public function __construct()
	{
		parent::__construct();
	}

	//liste des clients ou recherche d'un client
	public function lister($value=null){
		$arrayexecute=[];
		$ClientArray=[];
		if($value==null)
			$req=$this->Bdd()->prepare("select * from client");
		else{
			$req=$this->Bdd()->prepare("select * from client where Nom=:nom");
			$arrayexecute=array(
				"nom"=>$value
			);
		}

		$req->execute($arrayexecute);
		while($row=$req->fetch(PDO::FETCH_ASSOC)){
			$ClientArray[]=new Client($row);
			//$p->afficher();
		}
		return $ClientArray;
	}
	
	public function enregistrer($client,$update=null){
		if($update==null){
			$req=$this->Bdd()->prepare("INSERT INTO Client values(:nom,:villeresid,:profession)");
		}		
		else{
			$req=$this->Bdd()->prepare("UPDATE Client SET VilleResid=:villeresid,Profession=:profession WHERE Nom=:nom");
		}
		$req->execute(array(
			"nom"=>$client->Nom(),
			"villeresid"=>$client->VilleResid(),
			"profession"=>$client->Profession(),
		));
	}

	
	public function supprimer($client){
		$req=$this->Bdd()->prepare("DELETE from CLIENT WHERE NOM='".$client->Nom()."'");
		$req->execute();
	}	
}
?>