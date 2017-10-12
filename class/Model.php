<?php
Class Model{
	/**
	 * Class Constructor
	 * 
	 */
	public function __construct($tuple)
	{
		$this->hydrate($tuple);
	}

	public function hydrate($tuple)
    {
    	foreach($tuple as $key=>$value)
    	{
    		$method='set'.ucfirst($key);
    		if(method_exists($this, $method))
    		{
    			$this->$method($value);
    		}
    	}
    }
}
?>