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
						<h2> Register Missing Person </h2>
						  <?php
						  
								if(isset($_POST['regmissing'])){
								
									$name= mysql_escape_string($_POST['name']);
									$age= mysql_escape_string($_POST['age']);
									$desc= mysql_escape_string($_POST['desc']);
									$dateofmiss= mysql_escape_string($_POST['dateofmiss']);
									$timeofmiss= mysql_escape_string($_POST['timeofmiss']);
									$place= mysql_escape_string($_POST['place']);
									$tmp_name= $_FILES['image']['tmp_name'];
									$size=$_FILES['image']['size'];
									$filename= $_FILES['image']['name'];
									$sql="select * from missing where name='$name'";
									if(strtotime($dateofmiss) - strtotime(date('Y-M-d')) > 86400)
										{
											echo "<script type='text/javascript'>alert('Invalid Date!')</script>";									
										}
									
									else if(mysql_numrows($database->query($sql))==0)
									{
											
											if($size>200000){
												echo "<script>alert('Image size is more that the permitted value')</script>";
											}
											else {
												if(move_uploaded_file($tmp_name,"missing/".$filename))
												{
													
													$sql= "insert into missing values ('','$name','$age','$desc','$dateofmiss','$timeofmiss','$place','$user_id','$filename')";
													$database->query($sql);
													echo "<script type='text/javascript'>alert('Missing Person information successfully registered')</script>";
											
													//header('Location: missing.php');
												}
												else {
													echo "<script>alert('Upload Error !!!!')</script>";
												}
											}
									}
									else echo "<script type='text/javascript'>alert('You have already registered this person into the system!')</script>";
								}
							?>
						<form action="missing.php" enctype="multipart/form-data" method="post" >
						<table>
							<tr>
								<td><label>Enter Name</label></td>
								<td><input type="text" name="name" required="true"></td>
							</tr>
							<tr>
								<td><label>Age</label></td>
								<td><input type="text" name="age" required="true"></td>
							</tr>
							<tr>
								<td><label>Description<label></td>
								<td><textarea style="width: 250px; height: 132px;" name="desc" required="true"></textarea></td>
							</tr>
							<tr>
								<td><label>Upload Image<label></td>
								<td><input type="file" name="image" required></td>
							</tr>
							<tr>
								<td><label>Date of Missing</label></td>
								<td><input type="date" name="dateofmiss" required="true"></td>
							</tr>
							<tr>
								<td><label>Time of Missing</label></td>
								<td><input type="time" name="timeofmiss" required="true"></td>
							</tr>
							<tr>
								<td><label>Place</label></td>
								<td><input type="text" name="place"></td>
							</tr>
						</table>
							<input type="submit" name="regmissing" value="Report Missing Person">
						</form>
					</section>
	</div>
</body>
</html>