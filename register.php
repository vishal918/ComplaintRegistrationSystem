<?php
include_once("includes/database.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css?ver=2">
</head>

<body>
	<div id="wrapper">
			<header>
			<h2>Welcome to Online Crime Registration System</h2>
			</header>
					<section style="float: none; width: 100%;">
						
					<h2> Register </h2>
					<nav id="menu">
							<ul style="float:left">
								<li><a href="index1.php">Log-In</a></li>
								
							</ul>
							</nav>
						<?php
								if(isset($_POST['submit'])){
									$user_id='user'. rand(0,9).rand(0,9).rand(0,9).rand(0,9);
									$password= mysql_escape_string($_POST['password']);
									$name= mysql_escape_string($_POST['name']);
									$address= mysql_escape_string($_POST['address']);
									$phone_no= mysql_escape_string($_POST['phone_no']);
									$email= mysql_escape_string($_POST['email']);
									$dob= mysql_escape_string($_POST['dob']);
									
									$id_name= mysql_escape_string($_POST['id_name']);
									$id= mysql_escape_string($_POST['id']);
									$sql="select * from user where user_id='$user_id'";
									if(!filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[%*?]).*$/"))) || $password== $user_id || $password== $name)
										{
											echo "<script type='text/javascript'>alert('Invalid Password!')</script>";
										}
									else if(!filter_var($phone_no, FILTER_VALIDATE_REGEXP, array ("options"=>array("regexp"=>"/[0-9]{10}/")) ))
										{
											echo "<script type='text/javascript'>alert('Invalid Contact Number!')</script>";									
										}
									else if(strtotime($dob) - strtotime(date('Y-M-d')) >= 0)
										{
											echo "<script type='text/javascript'>alert('Invalid Date!')</script>";									
										}
									else
									{
										if(mysql_numrows($database->query($sql))==0){
												$sql= "insert into user values ('$user_id','$password','$name','$address','$phone_no','$email','$dob','$id_name','$id')";
												$database->query($sql);
												echo "<script type='text/javascript'>alert('Your User ID is $user_id !')</script>";
										}
										else echo "<script type='text/javascript'>alert('You have already registered into the system!')</script>";
									}
								}
						?>
						<form method="POST" action="register.php">
						<table>
							<tr>
								<td><label>Enter your Name</label></td>
								<td><input type="text" name="name" required="true" placeholder="Your Name"></td>
							</tr>
							<tr>
								<td><label>Enter password</label></td>
								<td><input type="password" name="password" required="true" placeholder="Password"></td>
								<div id="pass">Note: Password should be of minimum 8 characters with 1 Uppercase, 1 Lowercase, 1 interger value, 1 special character ?,*,%</div>
							</tr>
							<tr>
								<td><label>Enter your address</label></td>
								<td><textarea style="width: 250px; height: 132px;" name="address" required="true"></textarea></td>
							</tr>
							<tr>
								<td><label>Enter your number</label></td>
								<td><input type="tel" name="phone_no" required="true" placeholder="Contact No"></td>
							</tr>
							<tr>
								<td><label>Enter E-Mail</label></td>
								<td><input type="email" name="email" placeholder="abc@xyz.com"></td>
							</tr>
							<tr>
								<td><label>Enter Date of Birth</label></td>
								<td><input type="date" name="dob" required="true" placeholder="yyyy/mm/dd"></td>
							</tr>
							<tr>
								<td><label>Type of ID</label></td>
								<td><select name="id_name">
									<option value="Adhaar ID">Adhaar ID</option>
									<option value="Passport ID">Passport ID</option>
									<option value="Voter ID">Voter ID</option>
								</select></td>
							</tr>
							<tr>
								<td><label>Enter ID</label></td>
								<td><input type="text" name="id" required="true"></td>
							</tr>
						</table>
							<input type="submit" name="submit" value="Register">
						</form>
					</section>
	</div>
</body>
</html>