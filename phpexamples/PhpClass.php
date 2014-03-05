<?php 
// PHP 5 

// class definition 
class Bear { 
    // define properties 
    public $name; 
    public $age; 
    public $weight; 
    public $sex; 
    public $colour; 
    private $_lastUnitsConsumed; 

    // constructor 
    public function __construct() { 
        $this->age = 0; 
        $this->weight = 100; 
        $this->_lastUnitsConsumed = 0; 
    } 
     
    // define methods 
    public function eat($units) { 
        echo $this->name." is eating ".$units." units of food... "; 
        $this->weight += $units; 
        $this->_lastUnitsConsumed = $units; 
    } 

    public function getLastMeal() { 
        echo "Units consumed in last meal were ".$this->_lastUnitsConsumed." "; 
    } 
	    public function run() { 
        echo $this->name." is running... "; 
    } 

    public function kill() { 
        echo $this->name." is killing prey... "; 
    } 

} 
?>