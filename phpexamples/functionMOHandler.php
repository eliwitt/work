<?php
include('./functionDB.php');

function processMO($theInfo)
{
    global $first, $hit;
    $theRoot = "c:\\steve\\test\\";
    $message = "";
    //  check that the art folder is there and has something in it.
    //  create the xml
    $theDir = $theRoot . $theInfo->so . "\\" . $theInfo->mo . "\\art";
    if (!is_dir($theDir))
        $message = "Directory " . $theDir . " does not exists, please create and resubmit your request.";
    // now read all of the files in the directory and look for image files
    if ($message == "") {
        $dirlst = opendir($theDir);
        $foundart = 0;
        while($filename = readdir($dirlst)) {
            $filepath = $theDir . $filename;
            $file_parts = pathinfo($filepath);
            //echo "[" . $file_parts['extension'] . "]<br/>";
            if (preg_match('/(jpeg|jpg|png|gif)$/i', $file_parts['extension']))
                $foundart = 1;
        }
        if ($foundart == 0)
            $message = "No art files were found in " . $theDir;
    }
    //
    // if there are no errors then get the attrs 
    // and format them in the xml
    //
    if ($message == ""){
        $theattrs = array();
        $theprdattrs = "";
        $first = 1;
        $hit = 0;
        connect();
        get_the_mo_attr( $theattrs, $theInfo->mo );
        close_it();
        foreach($theattrs as $key => $value)
        {
            if (preg_match('/^(TRI|SSP|BU|WBU|EXT|TR|FL|FLT|JR|WTR|POS)/i', $key)){
                $hit = 0;
                if ($first == 1) {
                    $first = 0;
                    $theprdattrs .= theProduct($key, $value);
                }
                // height ft
                if ($hit == 0)
                    $theprdattrs .= theHeightFT($key, $value);
                // width ft
                if ($hit == 0)
                    $theprdattrs .= theWidthFT($key, $value);
                // height in
                if ($hit == 0)
                    $theprdattrs .= theHeightIN($key, $value);
                // width in
                if ($hit == 0)
                    $theprdattrs .= theWidthIN($key, $value);                   
                // pocket
                if ($hit == 0)
                    $theprdattrs .= thePocket($key, $value);
                // bleed
                if ($hit == 0)
                    $theprdattrs .= theBleed($key, $value);
                // material  Substrate
                if ($hit == 0)
                    $theprdattrs .= theMaterial($key, $value);
                // finishing
                if ($hit == 0)
                    $theprdattrs .= theFinishing($key, $value);
                // miscellaneous
                if ($hit == 0)
                    $theprdattrs .= theMisc($key, $value);
                // handle any other attrs
                if ($hit == 0)
                    $theprdattrs .= "<unknown>" . $key . "=" . $value . "</unknown>";
            } else {
                $message .= " attr " . $key . " has not been implemented at this time.<br/>";
            }
        }
        //$message .= $theprdattrs;
    }
    //  
    // if message is blank then we can create the xml file in its folder
    //
    if ($message == "") {
        $theDir = $theRoot . $theInfo->so . "\\" . $theInfo->mo . "\\xml";
        if (!is_dir($theDir)) {
            mkdir($theDir);
        }
        $fh_out = fopen($theDir . "\\" . $theInfo->mo . ".xml","w");
        $theHdr = "<?xml version='1.0' encoding='UTF-8' standalone='no'?>\n";
        $theHdr .= "<WFP>\n<JobPath>" . $theRoot . $theInfo->so . "\\" . $theInfo->mo . "</JobPath>\n";
        fwrite($fh_out, $theHdr);
        fwrite($fh_out, $theInfo->toXML());
        fwrite($fh_out, $theprdattrs . "</WFP>");
        fclose($fh_out);
    }
    return $message;
}
//
// this function translates the key into the product
//
function theProduct($theKey, $theValue){
    global $hit;
    $theprd = "";
    switch ($theKey) {
        case "JR10" :
            $theprd = "<Product>" . $theValue . "</Product>\n";
            $hit = 1;
            break;
        case "SSP10" :
            $theprd = "<Product>Clip</Product>\n";
            $hit = 1;
            break;
        case "FL010" :
            $theprd = "<Product>FLS</Product>\n";
            $hit = 1;
            break;
        case "TRI10" :
            $theprd = "<Product>TRI</Product>\n";
            $hit = 1;
            break;
        case "TR10" :
            $theprd = "<Product>TRS</Product>\n";
            $hit = 1;
            break;          
        case "BU10" :
            $theprd = "<Product>Bulletin</Product>\n";
            $hit = 1;
            break;
        case "EXT20" :
            $theprd = "<Product>Extension</Product>\n";
            $hit = 1;
            break;
        default:
            $theprd = "<unkonwn>" . $theKey . " and " . $theValue . "</unknown>\n";
            break;
    }
    return $theprd;
}
//
// height ft
//
function theHeightFT($theKey, $theValue){
    global $hit;
    $theHeight = "";
    switch ($theKey){
        case "FL010" :
            $theHeight = "<FlsHeight>" . $theValue . "</FlsHeight>\n";
            $hit = 1;
            break;      
        case "TRI30" :
            $theHeight = "<TriHeight>" . $theValue . "</TriHeight>\n";
            $hit = 1;
            break;
        case "BU10" :
            $theHeight = "<BulletinHeight>" . $theValue . "</BulletinHeight>\n";
            $hit = 1;
            break;
    }
    return $theHeight;
}
//
// width ft
//
function theWidthFT($theKey, $theValue){
    global $hit;
    $theWidth = "";
    switch ($theKey){
        case "FL030" :
            $theWidth = "<FlsWidth>" . $theValue . "</FlsWidth>\n";
            $hit = 1;
            break;      
        case "TRI10" :
            $theWidth = "<TriWidth>" . $theValue . "</TriWidth>\n";
            $hit = 1;
            break;
        case "BU30" :
            $theWidth = "<BulletinWidth>" . $theValue . "</BulletinWidth>\n";
            $hit = 1;
            break;
    }
    return $theWidth;
}
//
// height in
//
function theHeightIN($theKey, $theValue){
    global $hit;
    $theHeight = "";
    switch ($theKey){
        case "FL020" :
            $theHeight = "<FlsHeightInches>" . $theValue . "</FlsHeightInches>\n";
            $hit = 1;
            break;  
        case "FLT20" :
            $theHeight = "<FltHeightInches>" . $theValue . "</FltHeightInches>\n";
            $hit = 1;
            break;  
        case "TRI40" :
            $theHeight = "<TriHeightInches>" . $theValue . "</TriHeightInches>\n";
            $hit = 1;
            break;
        case "TR20" :
            $theHeight = "<TrHeightInches>" . $theValue . "</TrHeightInches>\n";
            $hit = 1;
            break;          
        case "BU20" :
            $theHeight = "<BulletinHeightInches>" . $theValue . "</BulletinHeightInches>\n";
            $hit = 1;
            break;
        case "EXT20" :
            $theHeight = "<ExtHeightInches>" . $theValue . "</ExtHeightInches>\n";
            $hit = 1;
            break;          
    }
    return $theHeight;
}
//
// width in
//
function theWidthIN($theKey, $theValue){
    global $hit;
    $theWidth = "";
    switch ($theKey){
        case "FL040" :
            $theWidth = "<FlsWidthInches>" . $theValue . "</FlsWidthInches>\n";
            $hit = 1;
            break;
        case "FTL10" :
            $theWidth = "<FltWidthInches>" . $theValue . "</FltWidthInches>\n";
            $hit = 1;
            break;                  
        case "TRI20" :
            $theWidth = "<TriWidthInches>" . $theValue . "</TriWidthInches>\n";
            $hit = 1;
            break;
        case "TR10" :
            $theWidth = "<TrWidthInches>" . $theValue . "</TrWidthInches>\n";
            $hit = 1;
            break;          
        case "BU40" :
            $theWidth = "<BulletinWidthInches>" . $theValue . "</BulletinWidthInches>\n";
            $hit = 1;
            break;
        case "EXT40" :
            $theWidth = "<ExtWidthInches>" . $theValue . "</ExtWidthInches>\n";
            $hit = 1;
            break;
    }
    return $theWidth;
}
//
// pocket
//
function thePocket($theKey, $theValue){
    global $hit;
    $thePocket = "";
    switch ($theKey){
        case "FL060" :
            $thePocket = "<TopPocket>" . $theValue . "</TopPocket>\n";
            $hit = 1;
            break;
        case "FL080" :
            $thePocket = "<BottomPocket>" . $theValue . "</BottomPocket>\n";
            $hit = 1;
            break;
        case "FL100" :
            $thePocket = "<LeftPocket>" . $theValue . "</LeftPocket>\n";
            $hit = 1;
            break;
        case "FL120" :
            $thePocket = "<RightPocket>" . $theValue . "</RightPocket>\n";
            $hit = 1;
            break;          
        case "BU60" :
            $thePocket = "<BulletinPocketInches>" . $theValue . "</BulletinPocketInches>\n";
            $hit = 1;
            break;
    }
    return $thePocket;
}
//
// bleed
//
function theBleed($theKey, $theValue){
    global $hit;
    $theBleed = "";
    switch ($theKey){
        case "FL050" :
            $theBleed = "<TopBleed>" . $theValue . "</TopBleed>\n";
            $hit = 1;
            break;
        case "FL070" :
            $theBleed = "<BottomBleed>" . $theValue . "</BottomBleed>\n";
            $hit = 1;
            break;
        case "FL090" :
            $theBleed = "<LeftBleed>" . $theValue . "</LeftBleed>\n";
            $hit = 1;
            break;
        case "FL110" :
            $theBleed = "<RightBleed>" . $theValue . "</RightBleed>\n";
            $hit = 1;
            break;          
        case "BU50" :
            $theBleed = "<BulletinBleedInches>" . $theValue . "</BulletinPocketInches>\n";
            $hit = 1;
            break;
    }
    return $theBleed;
}
//
// material substrate
//
function theMaterial($theKey, $theValue){
    global $hit;
    $theMaterial = "";
    switch ($theKey){
        case "TR30" :
        case "TRI70" :
        case "FLT30" :
        case "WTR70" :
        case "BU70" :
        case "WBU70" :
            $theMaterial = "<Substrate>" . $theValue . "</Substrate>\n";
            $hit = 1;
            break;
    }
    return $theMaterial;
}
//
// Finishing
//
function theFinishing($theKey, $theValue){
    global $hit;
    $theFinishing = "";
    switch ($theKey){
        case "TR40" :
        case "TRI80" :
        case "FLT40" :
        case "BU80" :
        case "POS10"    :       
        case "WBU80" :
            $theFinishing = "<Finishing>" . $theValue . "</Finishing>\n";
            $hit = 1;
            break;
    }
    return $theFinishing;
}
//
// miscellaneous attrs
//
function theMisc($theKey, $theValue){
    global $hit;
    $theMisc = "";
    switch ($theKey){
        case "TRI50" :
            $theMisc = "<Louvers>" . $theValue . "</Louvers>\n";
            $hit = 1;
            break;
        case "TRI60" :
            $theMisc = "<LouverWidth>" . $theValue . "</LouverWidth>\n";
            $hit = 1;
            break;          
    }
    return $theMisc;
}
//=================================================================
// end of file
//=================================================================
?>