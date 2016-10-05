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
	
	$dbLink = new mysqli('127.0.0.1', 'root', '', 'test');
	
	if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
    }
	
 
        // Create the SQL query
        $query = "
            INSERT INTO `xml` (
                `xmlkey`, `data`, `productname`, `version`
            )
            VALUES (
                '1', '{$asperaLink}', {$product}, '{$version}'
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