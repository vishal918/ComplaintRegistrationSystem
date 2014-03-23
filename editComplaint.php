<?php session_start();
include_once("includes/database.php");
include("header.php");
	$complaint_id=$_GET['cedit'];
	$sql="Select * from complaint where complaint_id='$complaint_id'";
	$result= mysql_query($sql);
	$row = mysql_fetch_array($result);
	$topic=$row['topic'];
	$subject= $row['subject'];
	$desc= $row['desc'];
	$location= $row['location'];
	$date= $row['date'];
	$time= $row['time'];
	$pname= $row['pname'];
	$paddress= $row['paddress'];
	$pcountry= $row['pcountry'];
	$pno= $row['pno'];
	$pemail= $row['pemail'];
	$visibility= $row['visibility'];
?>
<?php
								if(isset($_POST['Update']))
								{									
									$topic= mysql_escape_string($_POST['topic']);
									$subject= mysql_escape_string($_POST['subject']);
									$desc= mysql_escape_string($_POST['desc']);
									$location= mysql_escape_string($_POST['location']);
									$date= mysql_escape_string($_POST['date']);
									$time= mysql_escape_string($_POST['time']);
									$pname= mysql_escape_string($_POST['pname']);
									$paddress= mysql_escape_string($_POST['paddress']);
									$pcountry= mysql_escape_string($_POST['pcountry']);
									$pno= mysql_escape_string($_POST['pno']);
									$pemail= mysql_escape_string($_POST['pemail']);
									$visibility= mysql_escape_string($_POST['visibility']);
									$status= "Not Approved";
									if(strtotime($date) - strtotime(date('Y-M-d')) > 86400)
										{
											echo "<script type='text/javascript'>alert('Invalid Date!')</script>";									
										}
									else
									{
									$sql= "update complaint set topic='$topic',subject='$subject',`desc`='$desc',location='$location',date='$date',time='$time',pname='$pname',paddress='$paddress',pcountry='$pcountry',pno='$pno',pemail='$pemail',visibility='$visibility' where complaint_id='$complaint_id'";
									$database->query($sql);
									$insert_id=$database->insert_id();
									$cid= $insert_id;
									$sql1= "insert into complaintstatus values('$cid','$status')";
									$database->query($sql1);
									echo "<script type='text/javascript'>alert('You complaint is modified')</script>";
									}
								}
?>
						<section>					
								<nav id="menu">
									<ul style="float:left">
										<li><a href="logout.php">Log-Out</a></li>
										
									</ul>
								</nav>
								<h2> Edit Complaint </h2>
				
						<?php	echo "<form method='POST' action='editComplaint.php?cedit=$complaint_id'>
						<table>
							<tr>
								<td><label>Enter Complaint Topic</label></td>
								<td><input type='text' name='topic' required='true' value='$topic'></td>
							</tr>
							<tr>
								<td><label>Subject</label></td>
								<td><input type='text' name='subject' required='true' value='$subject'></td>
							</tr>
							<tr>
								<td><label>Description</label></td>
								<td><textarea style='width: 250px; height: 132px;' name='desc' required='true' >$desc</textarea></td>
							</tr>
							<tr>
								<td><label>Location</label></td>
								<td><input type='text' name='location' required='true' value='$location'></td>
							</tr>
							<tr>
								<td><label>Date</label></td>
								<td><input type='date' name='date' required='true' value='$date'></td>
							</tr>
							<tr>
								<td><label>Time</label></td>
								<td><input type='time' name='time' value='$time'></td>
							</tr>
							<tr>
								<td><label>Enter Prepator Name</label></td>
								<td><input type='text' name='pname' placeholder='Your Name' value='$pname'></td>
							</tr>
							<tr>
								<td><label>Enter Address</label></td>
								<td><textarea style='width: 250px; height: 132px;' name='paddress' required='true'>$paddress</textarea></td>
							</tr>
							<tr>
								<td><label>Enter Country</label></td>
								<td><input type='text' name='pcountry' value='$pcountry'></td>
							</tr>
							<tr>
								<td><label>Contact Number</label></td>
								<td><input type='integer' name='pno' required='true' value='$pno'></td>
							</tr>
							<tr>
								<td><label>E-mail ID</label></td>
								<td><input type='email' name='pemail' required='true' value='$pemail'></td>
							</tr>
							<tr>
								<td><label>Enter Visibility</label></td>
								<td><input type='boolean' name='visibility' required='true' value='$visibility'></td>
							</tr>
						</table>
						<input type='submit' name='Update' value='Update'>
						</form>" 
						?>
						</section>
</body>
</html>