<?php
    session_start();
	include_once("includes/database.php");
	if(isset($_POST['login']))
	{
		$user_id= $_POST['user_id'];
		$password= $_POST['password'];
		$sql="select * from user where user_id='$user_id' and password='$password'";
		$user= $database->query($sql);
		if(mysql_numrows($user)==1)
		{
		$row= mysql_fetch_array($user);
		$_SESSION['user_id']=$row['user_id'];
		echo "<script type='text/javascript'> alert('Valid login!!'); </script>";
		header('Location: main.php');
		}
		else 
		{
		echo "<script type='text/javascript'> alert('Invalid login!!'); </script>";        
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div id="wrapper">
			<header>
			<h2>Welcome to Online Crime Registration System</h2>
			</header>
			<hr>
				<aside>
					<div id="slider">
					<h3 style="text-align: center">Missing Persons</h3>
					
					</div>
					<div id="images">
						<a href="complaint.php"><img src="images/login.png" height="100px" width="100px"></a>
						<a href="miss.php"><img src="images/missing.png" height="100px" width="100px"></a>
						<a href="account.php"><img src="images/mypro.png" height="100px" width="100px"></a>
						<a href="searchme.php"><img src="images/reportissue.png" height="100px" width="100px"></a>
					</div>					
					</aside>
					<section style=" height: 500px;">										
						<nav id="menu">
							<ul>
								<li><a href="register.php">Register</a></li>
								<li><a href="index1.php">Log-In</a></li>
							</ul>
						</nav>
						<form action="" method="POST">
						<table>
							<tr>
								<td><label>Enter your ID</label></td>
								<td><input type="text" name="user_id" placeholder="user####" required="true"></td>
							</tr>
							<tr>
								<td><label>Enter your Password</label></td>
								<td><input type="password" name="password" required="true"></td>
							</tr>
						</table>
							<input type="submit" name="login">
						</form>
					</section>
	</div>
</body>
</html>