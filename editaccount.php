<?php session_start();
include_once("includes/database.php");
include("header.php");
	$user_id=$_SESSION['user_id'];
	$sql="Select * from user where user_id='$user_id'";
	$result= mysql_query($sql);
	$row = mysql_fetch_array($result);
	$password=$row['password'];
	$name=$row['name'];
	$address=$row["address"];
	$phone_no=$row["phone_no"];
	$email=$row["email"];
	$dob=$row["dob"];
	$id_name=$row["id_name"];
	$id=$row["id"];
?>
<?php
								if(isset($_POST['submit']))
								{	
									$user_id= $_SESSION['user_id'];
									$password= mysql_escape_string($_POST['password']);
									$name= mysql_escape_string($_POST['name']);
									$address= mysql_escape_string($_POST['address']);
									$phone_no= mysql_escape_string($_POST['phone_no']);
									$email= mysql_escape_string($_POST['email']);
									$dob= mysql_escape_string($_POST['dob']);
									$id_name= mysql_escape_string($_POST['id_name']);
									$id= mysql_escape_string($_POST['id']);
									if(!filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[%*?]).*$/"))) || $password== $user_id || $password== $name)
										{
											echo "<script type='text/javascript'>alert('Invalid Password. Please Check')</script>";
										}
									else if(!filter_var($phone_no, FILTER_VALIDATE_REGEXP, array ("options"=>array("regexp"=>"/[0-9]{10}/")) ))
										{
											echo "<script type='text/javascript'>alert('Invalid Contact Number. Please check')</script>";									
										}
									else if(strtotime($dob) - strtotime(date('Y-M-d')) >= 0)
										{
											echo "<script type='text/javascript'>alert('Invalid Date! Please Check')</script>";									
										}
									else
									{
									$sql= "update user SET password='$password',name='$name',address='$address',phone_no='$phone_no',email='$email',dob='$dob',id_name='$id_name',id='$id' where user_id='$user_id'";
									$database->query($sql);
									echo "<script type='text/javascript'>alert('Your Account Info has been updated')</script>";
									}
								}
								else{
								//echo 'aedefcewr';
								}
?>

					<section>
						
						<nav id="menu">
							<ul style="float:left">
								<li><a href="logout.php">Log-Out</a></li>
								
							</ul>
						</nav>
						<h2> Edit Account </h2>
	<?php	echo "<form method='POST' action='editaccount.php'>
						<table>
							<tr>
								<td><label>Enter your Name</label></td>
								<td><input type='text' name='name' value='$name' required='true'></td>
							</tr>
							<tr>
								<td><label>Enter password</label></td>
								<td><input type='password' name='password' value='$password' required='true'></td>
							</tr>
							<tr>
								<td><label>Enter your address</label></td>
								<td><textarea style='width: 250px; height: 132px;' name='address' required='true'>$address</textarea></td>
							</tr>
							<tr>
								<td><label>Enter your number</label></td>
								<td><input type='tel' name='phone_no' required='true' value='$phone_no'></td>
							</tr>
							<tr>
								<td><label>Enter E-Mail</label></td>
								<td><input type='email' name='email' value='$email'></td>
							</tr>
							<tr>
								<td><label>Enter Date of Birth</label></td>
								<td><input type='date' name='dob' required='true' value='$dob' placeholder='yyyy/mm/dd'></td>
							</tr>
							<tr>
								<td><label>Type of ID</label></td>
								<td><input type='text' name='id_name' value='$id_name' required='true'></td>
							</tr>
							<tr>
								<td><label>Enter ID</label></td>
								<td><input type='text' name='id' value='$id' required='true'></td>
							</tr>
						</table>
						<input type='submit' name='submit' value='Update'>
						</form>" ?>
	</div>
</body>
</html>