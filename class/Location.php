<?php
Class Location extends Model{
	private $_codeh;
	private $_nom;
	private $_nombMois;


    /**
     * Class Constructor
     * @param    $_codeh   
     * @param    $_nom   
     * @param    $_nombMois   
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
    public function Nom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $_nom
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
    public function NombMois()
    {
        return $this->_nombMois;
    }

    /**
     * @param mixed $_nombMois
     *
     * @return self
     */
    public function setNombMois($_nombMois)
    {
        $this->_nombMois = $_nombMois;

        return $this;
    }
}
?>