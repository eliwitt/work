<?php 
// PHP 5 

// class definition 
class MOInfo { 
    // define properties
    public $cuno; 
    public $mo; 
    public $so; 
    public $line; 
    public $advertisor; // olcope
    public $product;
    public $design; // olshmp
    public $csr; 
    public $email;
    public $qty;
    public $item;
     
    // define methods 
    public function toString() { 
        return $this->mo . "  so ". $this->so ." line " . $this->line . "  ad " . 
            $this->advertisor . " design " . $this->design . " prd " . $this->product . 
            " qty " . $this->qty . "<br /> csr " . $this->csr . " email " . $this->email . "<br />" .
            $this->item;
    } 

    //  format the xml
    public function toXML(){
        // I remove product from here to have it translated
        //         "<Product>" . $this->product . "</Product>\n" .

        $theXML = "<JobOrderNumber>" . $this->so . "</JobOrderNumber>\n" .
        "<JobOrderLine>" . $this->line . "</JobOrderLine>\n" .
        "<JobDesign>" . $this->design . "</JobDesign>\n" .
        "<JobAdvertiser>" . $this->advertisor . "</JobAdvertiser>\n" .
        "<JobMONumber>" . $this->mo . "</JobMONumber>\n" .
        "<CSR>" . $this->csr . "</CSR>\n" .
        "<EMAIL>" . $this->email . "</EMAIL>\n" .
        "<ITEM>" . $this->item . "</ITEM>\n" .
        "<CustomerNumber>" . $this->cuno . "</CustomerNumber>";
        return $theXML;
    }

} 
?>