<?php
	session_start();
	require('connect.php');

	$fmsg = "";
	
	if (isset($_POST['username']) and isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = "SELECT * FROM `user` WHERE username='$username' and password='$password'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);

		if ($count == 1){
			$_SESSION['username'] = $username;
		}
		else{
			$fmsg = "Invalid Login Credentials.";
		}
	}
	
	if (isset($_SESSION['username'])){
		session_start();
		$_SESSION['login'] = "1";
		header("Location: home.php");
	} else{
	}
?>

<html>
<head>
	<title>Misys FusionExpRSS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<br><br><br><br><br>
<div id = "page-wrap-login" class="roundedcorners">

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
	<table cellpadding = "6px">
		<tr>
			<td>
				<label class="tahoma">Username:</label>
			</td>
			<td/>
			<td>
				 <input type="text" name="username" id="textfield" placeholder="Username required">
			</td>
		</tr>
		<tr>
			<td>
				<label class="tahoma">Password:</label>
			</td>
			<td/>
			<td>
				<input type="password" name="password" id="inputPassword" placeholder="Password required">
			</td>
		</tr>	
		<tr>
			<td>
				<?php if ($fmsg != "") { ?>
					<span class = "errortahoma"><?php echo $fmsg;?> </span>
				<?php } ?>
			</td>
		</tr>
	</table>
	<table align="center" cellpadding = "5px">
		<tr>
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