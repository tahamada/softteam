<?php
Class Habitation extends Model{
	private $_codeh;
	private $_typeh;
    private $_adresse;
    private $_ville;
	private $_loyerM;


    /**
     * Class Constructor
     * @param    $_codeh   
     * @param    $_typeh   
     * @param    $_adresse   
     * @param    $_ville   
     * @param    $_loyerM   
     */
    public function __construct($tuple)
    {
       $this->hydrate($tuple);
    }	
    

    /**
     * @return mixed
     */
    public function Codeh()
    {
        return $this->_codeh;
    }

    /**
     * @param mixed $_codeh
     *
     * @return self
     */
    public function setCodeh($_codeh)
    {
        $this->_codeh = $_codeh;

        return $this;
    }

    /**
     * @return mixed
     */
    public function Typeh()
    {
        return $this->_typeh;
    }

    /**
     * @param mixed $_typeh
     *
     * @return self
     */
    public function setTypeh($_typeh)
    {
        $this->_typeh = $_typeh;

        return $this;
    }

    /**
     * @return mixed
     */
    public function Adresse()
    {
        return $this->_adresse;
    }

    /**
     * @param mixed $_adresse
     *
     * @return self
     */
    public function setAdresse($_adresse)
    {
        $this->_adresse = $_adresse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function Ville()
    {
        return $this->_ville;
    }

    /**
     * @param mixed $_ville
     *
     * @return self
     */
    public function setVille($_ville)
    {
        $this->_ville = $_ville;

        return $this;
    }

    /**
     * @return mixed
     */
    public function LoyerM()
    {
        return $this->_loyerM;
    }

    /**
     * @param mixed $_loyerM
     *
     * @return self
     */
    public function setLoyerM($_loyerM)
    {
        $this->_loyerM = $_loyerM;

        return $this;
    }    

}
?>