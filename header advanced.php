<?php print ("<!DOCTYPE html>");?>
<html>
<head>
	<meta charset="utf-8">
	<title>Legomania</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<!--Advance search--> 
<header><br><br><br><br><br><br><br><br><br><br>
<form name="wizard" action="advanced.php" method="post">
	<p id="input"><!--<label>-->
	<input type ="text" name = "SetID" placeholder = "Enter SetID" size = "10"/>
	<input type ="text" name = "Year" placeholder = "Enter year" size = "10"/>
	<input type ="text" name = "Setname" placeholder = "Enter Setname" size = "10"/>
	<input type ="text" name = "Categoryname" placeholder = "Enter Categoryname" size = "10"/>
	<input type ="text" name = "CatID" placeholder = "Enter CategoryID" size = "10"/>
	<input type ="text" name = "PartID" placeholder = "Enter PartID" size = "10"/>
	<!--</label>--><br>
	

	<input type = "submit" value = "Find!"/>
	<input type = "reset" value = "Clear"/>
	
	Show images: <input type = "checkbox" name = "image" value = "Show"> 
	</p>
</form>
</header>

<img id="background" src="background.jpg">
<div class="opacitybox">

