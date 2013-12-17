<?php print ("<!DOCTYPE html>");?>
<html>
<head>
	<meta charset="utf-8">
	<title>Legomania</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<!--Advance search--> 
<header>
<form name="wizard" action="advance.php" method="post">
	<p id="input"><label>
	<input type ="text" name = "setID" placeholder = "Enter SetID" size = "10"/>
	<input type ="text" name = "year" placeholder = "Enter year" size = "10"/>
	<input type ="text" name = "setname" placeholder = "Enter Setname" size = "10"/>
	<input type ="text" name = "categoryname" placeholder = "Enter Categoryname" size = "10"/>
	<input type ="text" name = "catID" placeholder = "Enter CategoryID" size = "10"/>
	<input type ="text" name = "partID" placeholder = "Enter PartID" size = "10"/>
	<br>
	</label></p>

	<input type = "submit" value = "Find lego!"/>
	<input type = "reset" value = "Clear"/>
	Show images: <input type = "checkbox" name = "image" value = "Show"> 
	</p>
</form>
</header>

<img id="background" src="background.jpg">
<div class="opacitybox">

