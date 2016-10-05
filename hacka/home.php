<html>
<head>
	<title>Misys FusionExpRSS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<?php
	session_start();
	require('connect.php');
	
	$id = "";
	$status = "";
	$productname1 = "";
	$version1 = "";
	$asperalink1 = "";
	
	$errorCount = 0;
	$error_msg_version = "";
	$error_msg_aspera = "";
	$version = isset($_POST['version']) ? $_POST['version'] : '';
	$asperaLink = isset($_POST['asperaLink']) ? $_POST['asperaLink'] : '';
	$product = isset($_POST['product']) ? $_POST['product'] : '';
	
	if($_POST) {
		if(empty($version)) {
			$errorCount++;
			$error_msg_version = "* Version number is required.";
		}

		if(empty($asperaLink)) {
			$errorCount++;
			$error_msg_aspera = "* Aspera link is required.";
		}
	}
	
	//if ($errorCount == 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
	//	if (isset($_POST['btnSubmit'])) {
	//		header("Location: //submit.php?product=".$product."&version=".$version."&asperaLink=".$asperaLink);
//		}
  //  }

	$username = $_SESSION['username'];
	$query = "SELECT * FROM `user` WHERE username='$username'";
	$result = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($result)) {
		$id = $row["id"];
	}
			
	if ($errorCount == 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['btnSubmit'])) {
		}
	}
?>

<br><br><br><br><br>
<div id = "page-wrap" class="roundedcorners">
<?php
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		header ("Location: login.php");
	}
?>
<table cellpadding = "5px">
	<tr>
		<td>
			<img src="images/misyslogo.png" alt="Misys Logo">
		</td>
		<td/>
		<td>
			<label class="tahoma"><b>Welcome to <i>Misys FusionExpRSS</i></b></label>
		</td>
	</tr>
</table>

<form action="" method="post">
	<table cellpadding = "8px">
		<tr>
			<td>
				<label class="tahoma">Product:</label>
			</td>
			<td/>
			<td>
				<select name="product" id="product">
					<option value="FusionBanking Essence">FusionBanking Essence</option>
					<option value="FusionBanking Equation">FusionBanking Equation</option>
					<option value="FusionBanking Midas">FusionBanking Midas</option>
					<option value="FusionBanking Lending">FusionBanking Lending</option>
					<option value="FusionBanking Loan IQ">FusionBanking Loan IQ</option>
					<option value="FusionBanking Trade Innovation">FusionBanking Trade Innovation</option>
					<option value="FusionBanking Corporate Channels">FusionBanking Corporate Channels</option>
					<option value="FusionBanking Payment Manager">FusionBanking Payment Manager</option>
					<option value="FusionBanking Message Manager">FusionBanking Message Manager</option>
					<option value="FusionCapital Kondor">FusionCapital Kondor</option>
					<option value="FusionCapital Opics">FusionCapital Opics</option>
					<option value="FusionCapital Sophis">FusionCapital Sophis</option>
					<option value="FusionCapital Summit">FusionCapital Summit</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label class="tahoma">Version:</label>
			</td>
			<td/>
			<td><input type="text" name="version" id="textfield" value="<?php if (isset($_GET['version1'])) { echo $_GET['version1']; } else { echo $version; } ?>" maxLength = "10"> 			
			<?php if ($error_msg_version != "") { ?>
				<br><span class = "errortahoma"><?php echo $error_msg_version;?> </span></br>
			<?php } ?>
			</td>
		</tr>	
		<tr>
			<td>
				<label class="tahoma">Aspera Link:</label>
			</td>
			<td/>
			<td><input type="text" name="asperaLink" id="textfield" value="<?php if (isset($_GET['asperaLink1'])) { echo $_GET['asperaLink1']; } else { echo $asperaLink; } ?>" maxLength = "50">
			<?php if ($error_msg_aspera != "") { ?>
				<br><span class = "errortahoma"><?php echo $error_msg_aspera;?> </span></br>
			<?php } ?>
			</td>
		</tr>
	</table>
	<table align="center" cellpadding = "5px">
		<tr>
			<td>
				<input type="reset" name="btnClear" class="btn"/>
			</td>
			<td/><td/>
			<td>	
				<input type="submit" name="btnSubmit" class="btn"/>
			</td>
		</tr>
	</table>
</form>
</div>

<table align="center" cellpadding = "2px">
	<tr>
		<td/><td/><td/><td/><td/><td/><td/><td/><td/>
		<td/><td/><td/><td/><td/><td/><td/><td/><td/>
		<td/><td/><td/><td/><td/><td/><td/><td/><td/>
		<td/><td/><td/><td/><td/><td/><td/><td/><td/>
		<td/><td/><td/><td/><td/><td/><td/><td/><td/>
		<td/><td/><td/><td/><td/><td/><td/><td/><td/>
		<td>
			<a href='logout.php' class="foottahoma">Logout</a>
		</td>
		<td>
			<label class="foottahoma">| &copy; Team JaCaMYlu</label>
		</td>
	</tr>	
</table>

<br><br>

<div id = "page-wrap-table">
<form action="" method="post">
	<?php
		$query1 = mysqli_query($connection, "SELECT * FROM feed WHERE makerkey='$id' or checkerkey='$id'");
		
		echo '<table class="table1">';
		$i = 0;
		while($fetch = mysqli_fetch_assoc($query1)){
			
			$status = $fetch['status']; 
			$checkerkey = $fetch['checkerkey'];
			$makerkey = $fetch['makerkey'];
			$xmlkey = $fetch['xmlkey'];
			
			if ($i == 0){
				echo '<th class="th1">Product</th>';
				echo '<th class="th1">Version</th>';
				echo '<th class="th1">Status</th>';
				echo '<th class="th1"></th>'; 
				
				$query2 = mysqli_query($connection, "SELECT * FROM xml WHERE xmlkey='$xmlkey'");
				
				echo '<th class="th1">'.$xmlkey.'</th>';
				
				
				while($fetch = mysqli_fetch_assoc($query2)){
					$productname1 = $fetch['productname']; 
					$version1 = $fetch['version'];
					$asperalink1 = $fetch['asperalink'];
				}
			}

			echo '<tr><td class="td1"><div class="tahoma">'.$productname1.'</div></td>';		
			echo '<td class="td1"><div class="tahoma">'.$version1.'</div></td>';	
			
			if ($status == 'R') {
				$status_text = 'Rejected';
				echo '<td class="td1"><div id="rejected" class="tahoma">'.$status_text.'</div></td>';
				if ($makerkey == $id) {
					echo '<td class="td1"><input type="submit" name="btnSubmitRejected[<?php $xmlkey ?>]" class="btn" value="Edit"/></td>';
				}	
			}
			else if ($status == 'W') {
				$status_text = 'Waiting for approval';
				echo '<tr><td class="td1"><div id="waiting-for-approval" class="tahoma">'.$status_text.'</div></td>';   
			}
			else {
				$status_text = 'Approved';
				echo '<td class="td1"><div id="approved" class="tahoma">'.$status_text.'</div></td>';
			}
			
			echo '</tr>';
			$i++;
		}
		echo '</table>';
		
		$code = key($_POST['btnSubmitRejected']);
		
		if (isset($_POST['btnSubmitRejected'][$code])) {
			header("Refresh: home.php?productname1=".$productname1."&version1=".$version1."&asperaLink1=".$asperalink1);
		}
	?>
</form>
</div>
</body>
</html>