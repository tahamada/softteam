<?php
Class Client extends Model{
	private $_nom;
	private $_villeResid;
	private $_profession;


	/**
	 * Class Constructor
	 * @param    $_Codeh   
	 * @param    $_villeResid   
	 * @param    $_profession   
	 */
	public function __construct($tuple)
	{
		$this->hydrate($tuple);
	}

	
    /**
     * @return mixed
     */
    public function Nom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $_Codeh
     *
     * @return self
     */
    public function setNom($_nom)
    {
        $this->_nom = $_nom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function VilleResid()
    {
        return $this->_villeResid;
    }

    /**
     * @param mixed $_villeResid
     *
     * @return self
     */
    public function setVilleResid($_villeResid)
    {
        $this->_villeResid = $_villeResid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function Profession()
    {
        return $this->_profession;
    }

    /**
     * @param mixed $_profession
     *
     * @return self
     */
    public function setProfession($_profession)
    {
        $this->_profession = $_profession;

        return $this;
    }

    public function afficher(){
    	echo  $this->Codeh()." ".$this->VilleResid()." ".$this->Profession()."<br/>";
    }
}
?>