<?php session_start();
include_once("includes/database.php");
include("header.php");
	$user_id=$_SESSION['user_id'];
	?>
					<section>
						
						<nav id="menu">
							<ul style="float:left">
								<li><a href="logout.php">Log-Out</a></li>
								
							</ul>
						</nav>
						<h2> Register Complaint </h2>
						  <?php
								if(isset($_POST['regcrime'])){
									
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
									$tmp_name= $_FILES['proof']['tmp_name'];
									$size=$_FILES['proof']['size'];
									$filename= $_FILES['proof']['name'];
									$sql="select * from complaint where date='$date' and time='$time'";
									if(strtotime($date) - strtotime(date('Y-M-d')) > 86400)
										{
											echo "<script type='text/javascript'>alert('Invalid Date!')</script>";									
										}
									else if(mysql_numrows($database->query($sql))==0){
											
											$sql= "insert into complaint values ('','$topic','$subject','$desc','$filename','$location','$date','$time','$pname','$paddress','$pcountry','$pno','$pemail','$visibility','$user_id')";
											$database->query($sql);
											$insert_id=$database->insert_id();
											$cid= $insert_id;
											$sql1= "insert into complaintstatus values('$cid','$status')";
											$database->query($sql1);
											if($size>200000){
												echo "<script>alert('Data size is more that the permitted value')</script>";
											}
											else {
												if(move_uploaded_file($tmp_name,"proof/".$filename)){
													echo "<script>alert('Upload Successful')</script>";
													
													header('Location: complaint_reg.php');
												}
												else {
													echo "<script>alert('Upload Error !!!!')</script>";
												}
											}
											echo "<script type='text/javascript'>alert('You complaint Id is $insert_id !')</script>";
									}
									else echo "<script type='text/javascript'>alert('You have already registered the same compliant into the system!')</script>";
								}
							?>
						<form method="POST" action="complaint_reg.php" enctype="multipart/form-data">
						<table>
							<tr>
								<td><label>Enter Complaint Topic</label></td>
								<td><input type="text" name="topic" required="true"></td>
							</tr>
							<tr>
								<td><label>Subject</label></td>
								<td><input type="text" name="subject" required="true"></td>
							</tr>
							<tr>
								<td><label>Description</label></td>
								<td><textarea style="width: 250px; height: 132px;" name="desc" required="true"></textarea></td>
							</tr>
							<tr>
								<td><label>Upload Proof<label></td>
								<td><input type="file" name="proof"></td>
							</tr>
							<tr>
								<td><label>Location</label></td>
								<td><input type="text" name="location" required="true"></td>
							</tr>
							<tr>
								<td><label>Date</label></td>
								<td><input type="date" name="date" required="true"></td>
							</tr>
							<tr>
								<td><label>Time</label></td>
								<td><input type="time" name="time"></td>
							</tr>
							<tr>
								<td><label>Enter Prepator Name</label></td>
								<td><input type="text" name="pname" placeholder="Your Name"></td>
							</tr>
							<tr>
								<td><label>Enter Address</label></td>
								<td><textarea style="width: 250px; height: 132px;" name="paddress" required="true"></textarea></td>
							</tr>
							<tr>
								<td><label>Enter Country</label></td>
								<td><input type="text" name="pcountry"></td>
							</tr>
							<tr>
								<td><label>Contact Number</label></td>
								<td><input type="integer" name="pno" required="true"></td>
							</tr>
							<tr>
								<td><label>E-mail ID</label></td>
								<td><input type="email" name="pemail" required="true"></td>
							</tr>
							<tr>
								<td><label>Enter Visibility</label></td>
								<td><input type="boolean" name="visibility" required="true"></td>
							</tr>
						</table>
							<input type="submit" name="regcrime" value="Register Complaint">
						</form>
					</section>
	</div>
</body>
</html>