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
		
		$xmldoc->save( $fileName );
		
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
	
	
		$xmldoc->save( $fileName );
	}	
	
?>