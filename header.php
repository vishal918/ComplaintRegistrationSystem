<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="javascript/jQuerySlider/themes/generic.css" rel="stylesheet" type="text/css" />
    <link href="javascript/jQuerySlider/themes/1/slider.css" rel="stylesheet" type="text/css" />
	<link href="javascript/jQuerySlider/themes/4/Tooltip.css" rel="stylesheet" type="text/css" /> 
	<script src="javascript/jQuerySlider/themes/4/Tooltip.js" type="text/javascript"></script>
    <script src="javascript/jQuerySlider/themes/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="javascript/jQuerySlider/themes/1/jquery-slider.js" type="text/javascript"></script>
	<script src="javascript/jquery-ui/js/jquery-1.9.1.js" type="text/javascript"></script>
	
</head>

<body>
	<div id="wrapper">
			<header>
			<h2>Welcome to Online Crime Registration System</h2>
			</header>
			<aside>
					<div id="slider">
					<h3 style="text-align: center">Missing Persons</h3>
						<div class="div2">
							<div id="mcts1">
							<?php
							$sql = "select * from `missing`";
							$query = mysql_query($sql);
							while($q = mysql_fetch_assoc($query))
							{
								echo '<img src="missing/'.$q['path'].'"style="width:75px;height:75px;" onmouseover="tooltip.pop(this,\''.$q['name'].'('.$q['age'].')<br />'.$q['desc'].'\')"/>';
							}
							?>
							</div>
						</div>
					
					</div>
					<div id="images">
						<a href="complaint_reg.php"><img src="images/login.png" height="100px" width="100px"></a>
						<a href="missing.php"><img src="images/missing.png" height="100px" width="100px"></a>
						<a href="editaccount.php"><img src="images/mypro.png" height="100px" width="100px"></a>
						<a href="search.php"><img src="images/reportissue.png" height="100px" width="100px"></a>
					</div>					
					</aside>
					