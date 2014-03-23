<?php 
session_start();
include_once("includes/database.php");
	if(!isset($_SESSION['user_id']))
	{
	header('Location: index.php');
	}
	include("header.php"); 
?>
					
					
					<section>
						<nav id="menu">
							<ul style="float:left">
								<li><a href="logout.php">Log-Out</a></li>
								
							</ul>
						</nav>
						
						<h2> Add Complaint/Missing Person </h2>
						<div id="images">
							<a href="complaint_reg.php"><img src="images/reportissue.png" height="250px" width="250px"></a>
							<a href="missing.php"><img src="images/missing.png" height="250px" width="250px"></a>
						</div>
					</section>
	</div>
</body>
</html>