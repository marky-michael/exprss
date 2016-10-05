
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
			header("Location: submit.php");
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
				<select id="product">
					<option value="opt1">FusionBanking Essence</option>
					<option value="opt2">FusionBanking Equation</option>
					<option value="opt3">FusionBanking Midas</option>
					<option value="opt4">FusionBanking Lending</option>
					<option value="opt5">FusionBanking Loan IQ</option>
					<option value="opt6">FusionBanking Trade Innovation</option>
					<option value="opt7">FusionBanking Corporate Channels</option>
					<option value="opt8">FusionBanking Payment Manager</option>
					<option value="opt9">FusionBanking Message Manager</option>
					<option value="opt10">FusionCapital Kondor</option>
					<option value="opt11">FusionCapital Opics</option>
					<option value="opt12">FusionCapital Sophis</option>
					<option value="opt13">FusionCapital Summit</option>
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