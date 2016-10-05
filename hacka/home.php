
<html>
<head>
	<title>Misys FusionExpRSS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<?php
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
	
	if ($errorCount == 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['btnSubmit'])) {
			header("Location: submit2.php?product=".$product."&version=".$version."&asperaLink=".$asperaLink);
		}
    }
?>

<br><br><br><br><br>
<div id = "page-wrap" class="roundedcorners">

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
			<td><input type="text" name="version" id="textfield" value="<?php echo $version; ?>"> 
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
			<td><input type="text" name="asperaLink" id="textfield" value="<?php echo $asperaLink; ?>">
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

</body>

</html>