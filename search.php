<?php session_start();
include_once("includes/database.php");
include("header.php");
	$user_id=$_SESSION['user_id'];
	?>
<?php
	if(isset($_GET['cstatus'])){
		$statusID= $_GET['cstatus'];
		$sql= "select status from complaintstatus where cid=$statusID";
		$result= $database->fetch_array($database->query($sql));
		echo "<script>alert('{$result['status']}')</script>";
	}
?>
					<section>
					<nav id="menu">
							<ul style="float:left">
								<li><a href="logout.php">Log-Out</a></li>
								
							</ul>
						</nav>
						<h2> Search/View Complaint </h2>
					<br> <br>
					<form action="search.php" method="POST">
					<table>
						<tr><td><label>Enter your ID</label></td>
						<td><input type="text" name="cid" required></td>
						<td><input type="submit" name="find" value="Click Me"></td>
						</tr>
						</table>
						</form>
						<?php
						$sql="(Select * from complaint where `user_id` = '$user_id') union (Select * from complaint where `user_id` != '$user_id' AND visibility = 1)";
	$result= mysql_query($sql);
		echo "<form method='POST' action='editaccount.php'>
						<table>
							<tr>
								<td><label>Complaint ID : </label></td>
								<td><label>Topic: </label></td>
								<td><label>Subject</label></td>
								<td><label>Description</label></td>
								<td><label>Location</label></td>
								<td><label>Date</label></td>
								<td><label>Time</label></td>
							</tr>
							</form>";
	if(!isset($_POST['find']))
	{
			while($row = mysql_fetch_array($result))
			{
			$complaint_id=$row['complaint_id'];
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
							
								echo "
									<tr>
									<td>$complaint_id</td>
									<td>$topic</td>
									<td>$subject</td>
									<td>$desc</td>
									<td>$location</td>
									<td>$date</td>
									<td>$time</td>
									";
									if($row['user_id'] == $user_id)
									{
										echo "<td><a href='search.php?cstatus=$complaint_id'>Check Status</a></td>
										<td><a href='editComplaint.php?cedit=$complaint_id'>Edit Complaint</a></td>
										";
									}
									echo "</tr>";
			}
		}
			else
			{
					$sql= "select * from complaint where complaint_id={$_POST['cid']}";
					$result= mysql_query($sql);
					$row = mysql_fetch_array($result);
					$complaint_id=$row['complaint_id'];
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
					if(mysql_numrows($database->query($sql))==0)
					{
					echo "No Record Found";
					}
					else
					{
									echo "
									<tr>
									<td>$complaint_id</td>
									<td>$topic</td>
									<td>$subject</td>
									<td>$desc</td>
									<td>$location</td>
									<td>$date</td>
									<td>$time</td>
									";
									if($row['user_id'] == $user_id)
									{
										echo "<td><a href='search.php?cstatus=$complaint_id'>Check Status</a></td>
										<td><a href='editComplaint.php?cedit=$complaint_id'>Edit Complaint</a></td>
										";
									}
									echo "</tr>";
					}
					}
	
	
	
	echo "</table>";
?>
						
					</section>
	</div>
</body>
</html>