<?php
//=================================================================
//
// connect to the database
//
//=================================================================
function connect() {
	global $pdo, $debug;
	if ($debug == 1)
		echo "<p> Connect to DB odbc </p>";
	try {
		$pdo = new PDO("odbc:vt2662afvp", "jcengage", "jc");
	}
	catch (PDOException $exception){
		echo "<p>" . $exception->getMessage() . "</p>";
		exit;
	}
}
//=================================================================
// retrieve the attrs for the job
//=================================================================
function get_the_mo_attr( &$theattr, $themo ) {
	global $pdo, $debug;
	try {
		if ($debug == 1)
			echo "<p> Read the attrs using " . $themo . "</p>";
		$stmt = $pdo->prepare('select boshce, rtrim(boyvcd) boyvcd, rtrim(boyxcd) boyxcd, boogqt
		from vt2662afvp.mfmohr MFG
			left join vt2662afvp.sroorspl theLine on MFG.aybmnb = theLine.olorno and MFG.aywdnb = theLine.olline
			left join vt2662afvp.mfcisa PrdAttr on theLine.olprdc = PrdAttr.boshce
		where aya4nb = :MONU');

		$stmt->execute( array( ':MONU' => $themo ) );

        // Print results for each rowset returned. We will get 1 rowset for
        // each SELECT. The first will be any records found (which may be empty)
        // and the second with be a count of the records returned by the first
        // (which may be zero). Note this relies on SQL Server returning this
        // value after a SELECT.
        do {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// var_dump($result);
            foreach($result as $row => $rst)
            {
                $attrcd = "";
                $attrtxt = "";
                $attrnu = "";
                // These keys will exists if this rowset is a record
                if (array_key_exists('BOYVCD', $rst)) $attrcd = $rst['BOYVCD'];
                if (array_key_exists('BOYXCD', $rst)) $attrtxt = $rst['BOYXCD'];
                if (array_key_exists('BOOGQT', $rst)) $attrnu = $rst['BOOGQT'];
                //echo $attrcd . " " . $attrtxt . " " . $attrnu . "<br />";
                if ($attrtxt == "") {
                    $theattr[$attrcd] = $attrnu;
                } else {
                    $theattr[$attrcd] = $attrtxt;
                }
            }
        } while ($stmt->nextRowset());
        //var_dump($theattr);
            // Close statement and data base connection
    	unset($stmt);
    }
	catch(Exception $e) {
    	echo $e->getMessage();
	}
}
//=================================================================
//
// clear the object
//
//=================================================================
function close_it() {
	global $pdo;
	//echo "<p> Close the DB odbc </p>";
	unset($pdo);
}
//=================================================================
//
// this function retrieves the information about the job such as
// so, line, mo, csr, and etc.
//
//=================================================================
function get_the_mo_info( &$moStuff ) {
	global $pdo, $debug;

	try {
		if ($debug == 1)
			echo "<p> Read the info using " . $moStuff->mo . "</p>";
		$stmt = $pdo->prepare("select rtrim(olcuno) cust, olorno, olline, rtrim(olprdc) prdcode, rtrim(ohcope) advertiser, rtrim(ohhand) csr, 
                rtrim(substring(ulcpar, 7)) email, Aya4nb, ayqty, rtrim(oldesc) Product, rtrim(olshpm) design
            from vt2662afvp.mfmohr MFG
                left join vt2662afvp.sroorspl theLine on MFG.aybmnb = theLine.olorno and MFG.aywdnb = theLine.olline
                left join vt2662afvp.sroorshe sohdr on mfg.aybmnb = sohdr.ohorno
                left join VT2662AFVP.SROUSP userpro on sohdr.ohhand = UPHAND
                left join VT2662AFVP.SROCLL usercon on  '*USERPROF' = ULUCTP AND 'MAIL' = ULCLNT AND userpro.upuser = ULUSER
            where aya4nb = :MONU");
		$stmt->execute( array( ':MONU' => $moStuff->mo ) );

        // Print results for each rowset returned. We will get 1 rowset for
        // each SELECT. The first will be any records found (which may be empty)
        // and the second with be a count of the records returned by the first
        // (which may be zero). Note this relies on SQL Server returning this
        // value after a SELECT.
        do {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// var_dump($result);
            foreach($result as $row => $rst)
            {
            	if ($debug == 1)
                    echo "<p> get the data " . $moStuff->mo . "</p>";
            	// These keys will exists if this rowset is a record
                if (array_key_exists('CUST', $rst)) $moStuff->cuno = $rst['CUST'];
                if (array_key_exists('OLORNO', $rst)) $moStuff->so = $rst['OLORNO'];
                if (array_key_exists('OLLINE', $rst)) $moStuff->line = $rst['OLLINE'];
       			if (array_key_exists('AYA4NB', $rst)) $moStuff->mo = $rst['AYA4NB'];
       			if (array_key_exists('ADVERTISER', $rst)) $moStuff->advertisor = $rst['ADVERTISER'];
                if (array_key_exists('PRODUCT', $rst)) $moStuff->product = $rst['PRODUCT'];
                if (array_key_exists('DESIGN', $rst)) $moStuff->design = $rst['DESIGN'];
                if (array_key_exists('CSR', $rst)) $moStuff->csr = $rst['CSR'];
                if (array_key_exists('EMAIL', $rst)) $moStuff->email = $rst['EMAIL'];
                if (array_key_exists('AYQTY', $rst)) $moStuff->qty = $rst['AYQTY'];
                if (array_key_exists('PRDCODE', $rst)) $moStuff->item = $rst['PRDCODE'];
            }
        } while ($stmt->nextRowset());

            // Close statement and data base connection
    	unset($stmt);
    }
	catch(Exception $e) {
    	echo $e->getMessage();
	}
}
//=================================================================
//
// this function retrieves the information about the job such as
// so, line, mo, csr, and etc. using the SO which could retrieve
// several MOs
//
//=================================================================
function get_the_so_info( $orno ) {
    global $pdo, $debug;
    $first = 0;
    $soArray[] = array();
    try {
        if ($debug == 1)
            echo "<p> Read the so info using " . $orno . "</p>";
        $stmt = $pdo->prepare("select rtrim(olcuno) cust, olorno, olline, rtrim(olprdc) prdcode, rtrim(ohcope) advertiser, rtrim(ohhand) csr, 
                rtrim(substring(ulcpar, 7)) email, Aya4nb, ayqty, rtrim(oldesc) Product, rtrim(olshpm) design
            from vt2662afvp.mfmohr MFG
                left join vt2662afvp.sroorspl theLine on MFG.aybmnb = theLine.olorno and MFG.aywdnb = theLine.olline
                left join vt2662afvp.sroorshe sohdr on mfg.aybmnb = sohdr.ohorno
                left join VT2662AFVP.SROUSP userpro on sohdr.ohhand = UPHAND
                left join VT2662AFVP.SROCLL usercon on  '*USERPROF' = ULUCTP AND 'MAIL' = ULCLNT AND userpro.upuser = ULUSER
            where aybmnb = :SONU");
        $stmt->execute( array( ':SONU' => $orno ) );

        // Print results for each rowset returned. We will get 1 rowset for
        // each SELECT. The first will be any records found (which may be empty)
        // and the second with be a count of the records returned by the first
        // (which may be zero). Note this relies on SQL Server returning this
        // value after a SELECT.
        do {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // var_dump($result);
            foreach($result as $row => $rst)
            {
                if ($debug == 1)
                    echo "<p> get the data " . $orno . "</p>";
                // These keys will exists if this rowset is a record
                $soData = new MOInfo;
                if (array_key_exists('CUST', $rst)) $soData->cuno = $rst['CUST'];
                if (array_key_exists('OLORNO', $rst)) $soData->so = $rst['OLORNO'];
                if (array_key_exists('OLLINE', $rst)) $soData->line = $rst['OLLINE'];
                if (array_key_exists('AYA4NB', $rst)) $soData->mo = $rst['AYA4NB'];
                if (array_key_exists('ADVERTISER', $rst)) $soData->advertisor = $rst['ADVERTISER'];
                if (array_key_exists('PRODUCT', $rst)) $soData->product = $rst['PRODUCT'];
                if (array_key_exists('DESIGN', $rst)) $soData->design = $rst['DESIGN'];
                if (array_key_exists('CSR', $rst)) $soData->csr = $rst['CSR'];
                if (array_key_exists('EMAIL', $rst)) $soData->email = $rst['EMAIL'];
                if (array_key_exists('AYQTY', $rst)) $soData->qty = $rst['AYQTY'];
                if (array_key_exists('PRDCODE', $rst)) $soData->item = $rst['PRDCODE'];
                $first = 1;
                if ($debug == 1)
                    print_r($soData);
                $soArray[] = $soData;
                unset($soData);
            }
        } while ($stmt->nextRowset());

            // Close statement and data base connection
        unset($stmt);
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }
    return $soArray;
}
//=================================================================
// end of file
//=================================================================
?>