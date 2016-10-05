<?php
	
	if (isset($_GET['product'])) {    
		$product = $_GET['product'];
	}

	if (isset($_GET['version'])) {    
		$version = $_GET['version'];
	}
	
	if (isset($_GET['asperaLink'])) {    
		$asperaLink = $_GET['asperaLink'];
	}
	
	$fileName = $product.'RSS.xml';
	$xmldoc = new DOMDocument;
	$titlePreset = 'A new version for '.$product.' has been released';
	$releaseDescriptionPreset = $product.' version '.$version.' is now released. 
	Here is the the aspera link for this delivery :: ' . $asperaLink;
	
	
	//Database connection
	$dbLink = new mysqli('127.0.0.1', 'root', '', 'test');
	
	if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
    }
	
 
        
	
	// Append new items to existing XML
	if( $xml = file_get_contents( $fileName ) ) {
		$xmldoc->loadXML( $xml, LIBXML_NOBLANKS );
		
		$root = $xmldoc->getElementsByTagName('channel')->item(0);
		
		 // create the <product> tag
		$item = $xmldoc->createElement('item');
	
		
		$root->insertBefore( $item , $root->lastChild );

		$titleElement = $xmldoc->createElement('title');
		$item->appendChild($titleElement);
		$itemText = $xmldoc->createTextNode($titlePreset);
		$titleElement->appendChild($itemText);
		
		
		$descriptionElement = $xmldoc->createElement('description');
		$item->appendChild($descriptionElement);
		$descriptionText = $xmldoc->createCDATASection($releaseDescriptionPreset.'&#13;&#10;<img src="http://localhost/hacka/images/MISYSLOGO2.png" alt=""  width="800" height="450"/>');
		$descriptionElement->appendChild($descriptionText);
		
		//$xmldoc->save( $fileName );
		
		$xmlString = $xmldoc->saveXML($xmldoc);
		
		
 
		
	}
	else{

		$data = '<?xml version="1.0" encoding="UTF-8" ?>';
		$data .= '<rss version="2.0">';
		$data .= '<channel>';
		$data .= '<title>Misys '.$product.' Notifications</title>';
			$data .= '<item>';
				$data .= '<title>'.$titlePreset.'</title>';
				$data .= '<description><![CDATA['.$releaseDescriptionPreset.'&#13;&#10;<img src="http://localhost/hacka/images/MISYSLOGO2.png" alt=""  width="800" height="450"/>]]></description>';
			$data .= '</item>';
		$data .= '</channel>';
		$data .= '</rss> ';
		
		
		$xmldoc->preserveWhiteSpace = FALSE;
		$xmldoc->loadXML($data);	
	
	
		//$xmldoc->save( $fileName );
		
		$xmlString = $xmldoc->saveXML($xmldoc);
	}	
	
	// Create the SQL query
        $query = "
            INSERT INTO `xml` (
                `data`, `productname`, `version`, `asperalink`
            )
            VALUES (
                '{$xmlString}', '{$product}', '{$version}','{$asperaLink}'
            )";
	
	 // Execute the query
        $result = $dbLink->query($query);
		
		// Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
	
		
	
		$dbLink->close();
	
?>
