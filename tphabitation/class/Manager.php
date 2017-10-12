<?php
abstract Class Manager implements Enregistrable{
	const BDD_PARAM=array("mysql:host=localhost;dbname=location;charset=utf8","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	private $_bdd;
	public function __construct()
	{
		try
		{
			$bdd= new PDO(self::BDD_PARAM[0],self::BDD_PARAM[1],self::BDD_PARAM[2],self::BDD_PARAM[3]); 	
			$this->setBdd($bdd);		
			
		}catch(Exception $e){
			die("Erreur: ".$e->getMessage());
		}

	}

    /**
     * @return mixed
     */
    public function Bdd()
    {
        return $this->_bdd;
    }

    /**
     * @param mixed $_bdd
     *
     * @return self
     */
    public function setBdd($_bdd)
    {
        $this->_bdd = $_bdd;

        return $this;
    }
    public function getTable(){
    	return str_replace("Manager","",get_Class($this));
    } 

    //retourne la liste des colonnes et les cle primairesde la table
    public function getAttr(){
    	$table= $this->getTable();  	
    	//colonne
    	$r = $this->Bdd()->prepare("DESCRIBE $table");
		$r->execute();
		$table_colonne = $r->fetchAll(PDO::FETCH_COLUMN);
		//primary key
		$rprimary = $this->Bdd()->prepare("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
		$rprimary->execute();
		$table_primarykey = $rprimary->fetchAll();
		$pk=[];
		foreach($table_primarykey as $keytable){
			$pk[]=$keytable[4];
		}
		return array("columns"=>$table_colonne,"pk"=>$pk);
    }

    public function enregistrer2($objet,$update=null){
    	$table= $this->getTable(); 
		$AtrrArray=$this->getAttr();	
    	if($update==null){
    		//creation de la partie value pour une insertion
    		$value="";
			$i=0;
			foreach($AtrrArray['columns'] as $column){
				$value.=":".$column;
				if($i<count($AtrrArray['columns'])-1)
					$value.=",";
				$i++;
			}				

			$req=$this->Bdd()->prepare("INSERT INTO $table values($value)");
		}		
		else{
			//partie where cle primaire
			$pkvalue="";
			$i=0;
			foreach($AtrrArray['pk'] as $pk){
				$pkvalue.=$pk."=:".$pk;
				if($i<count($AtrrArray['pk'])-1)
					$pkvalue.=" and ";
				$i++;
			}

			if($i==0){
				$pkvalue.=$AtrrArray['columns'][0]."=:".$AtrrArray['columns'][0];
			}

			//partie modification SET
			$setvalue="";
			$i=0;
			foreach($AtrrArray['columns'] as $column){
				if(!in_array($column,$AtrrArray['pk'])){
					$setvalue.=$column."=:".$column;
					if($i<count($AtrrArray['columns'])-1)
						$setvalue.=",";
				}
				$i++;
			}

			$req=$this->Bdd()->prepare("UPDATE $table SET $setvalue WHERE $pkvalue");
		}

		//tableau preparer
		$prepArray=[];

		foreach($AtrrArray['columns'] as $column){
			$prepArray[$column] = $objet->$column();
		}
		$req->execute($prepArray);
    }

    public function supprimer2($objet){
    	$table= $this->getTable(); 
    	$AtrrArray=$this->getAttr();
    	//where
    	$where="";
		$i=0;
		foreach($AtrrArray['pk'] as $pk){
			$where.=$pk."='".$objet->$pk()."'";
			if($i<count($AtrrArray['pk'])-1)
				$where.=" and ";
			$i++;
		}		
		
		$req=$this->Bdd()->prepare("DELETE from $table WHERE $where");
		$req->execute();
	}

	public function lister2($value=null,$column=[]){
		$table= $this->getTable(); 

		$arrayexecute=[];
		$ClientArray=[];
		if(empty($column))
			$column="*";
		else
			$column=implode(",",$column);
		if($value==null)
			$req=$this->Bdd()->prepare("select distinct $column from $table");
		else{
			$where="";
			$i=0;
			foreach($value as $key=>$val){
				$comparateur="=";
				if(strpos($val,"<")!==false){
					$comparateur="<=";
					$val=str_replace("<","",$val);
				}
				elseif(strpos($val,">")!==false){
					$comparateur=">=";
					$val=str_replace(">","",$val);
				}
				$where.=str_replace("_","",$key)."$comparateur:$key";
				$arrayexecute[$key]=$val;
				if($i<count($value)-1)
					$where.=" and ";
				$i++;
			}	
			$req=$this->Bdd()->prepare("select * from $table where $where");
			
		}
		$req->execute($arrayexecute);
		
		while($row=$req->fetch(PDO::FETCH_ASSOC)){
			$ClientArray[]=new $table($row);
			//$p->afficher();
		}
		return $ClientArray;
	}

    
}
?>