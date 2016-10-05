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

	$data = '<?xml version="1.0" encoding="UTF-8" ?>';
	$data .= '<rss version="2.0">';
	$data .= '<channel>';
	$data .= '<title>Misys FusionExpRSS Notification</title>';
	$data .= '<link>http://www.jacamylu.com</link>';
	$data .= '<description>TEST NOTIFICATION</description>';
		$data .= '<item>';
	    	$data .= '<title>'.$product.'</title>';
			$data .= '<link>'.$version.'</link>';
			$data .= '<description>'.$asperaLink.'</description>';
		$data .= '</item>';
	$data .= '</channel>';
	$data .= '</rss> ';
 


	
	
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = FALSE;
	$dom->loadXML($data);
	
	
	$fileName = $product.'RSS.xml';
	$dom->save($fileName);
	
	header("Location: home.php")
?>