<?php print ("<!DOCTYPE html>");?>
<html>
<head>
	<meta charset="utf-8">
	<title>Legomania</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="wrapper">
		<div id="header">
		<!--Advance search--> 
		<form name="wizard" action="advanced.php" method="get">
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
			
			Show images: <input type = "checkbox" name = "image" value = "Show" checked> 
			</p>
		</form>
		<img id="questionAdv" src="Questionmark_adv.png" alt="questionmark" 
			title="You can use advanced search to find sets according to more specific details by inputting multiple pieces of information. When searching for the setname or categoryname the search will display similar results to your input, for the other attributes the search terms need to be exact."/>
		
		</div><!--sluttagg header-->
	<div id="content">

		<img id="background" src="background.jpg">
		<div class="opacitybox">

