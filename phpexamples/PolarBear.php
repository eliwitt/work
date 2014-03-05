<?php
// extended class definition 
class PolarBear extends Bear { 

    // constructor 
    public function __construct() { 
        parent::__construct(); 
        $this->colour = "white"; 
        $this->weight = 600; 
    } 

    // define methods 
    public function swim() { 
        echo $this->name." is swimming... "; 
    } 
} 
?>