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
		<!--bakgrund i header-->
                <img id="headerpic" src="bakgrundopacityadv.png">
                <!--bild finns http://www.student.itn.liu.se/~lovha997/bakgrundopacityadv.png-->
                
		<!--Advance search--> 
		<form id ="wizard" name="wizard" action="advanced.php" method="get">
		
					<!--länk till startsidan-->
                        <a id="home" href="https://www.facebook.com/">
                        <img src="homebutton.png"> </a>

                        <!--Forumlänk-->
                        <a id="forum" href="http://www.sermon.se/legoforum">
                        <img src="forumbutton12.png"></a>
						
					<p id="input"><!--<label>-->
			<input type ="text" name = "SetID" placeholder = "Enter SetID" size = "10"/>
			<input type ="text" name = "Year" placeholder = "Enter year" size = "10"/>
			<input type ="text" name = "Setname" placeholder = "Enter Setname" size = "10"/>
			</br>
			<input type ="text" name = "Categoryname" placeholder = "Enter Categoryname" size = "10"/>
			<input type ="text" name = "CatID" placeholder = "Enter CategoryID" size = "10"/>
			<input type ="text" name = "PartID" placeholder = "Enter PartID" size = "10"/>
			<!--</label>--><br>
			

			<input type = "submit" value = "Find"/>
			<input type = "reset" value = "Clear"/>
			<img id="questionAdv" src="Questionmark_adv.png" alt="questionmark" 
			title="You can use advanced search to find sets according to more specific details by inputting multiple pieces of information. When searching for the setname or categoryname the search will display similar results to your input, for the other attributes the search terms need to be exact."/>
			
			<div class="litentext">
                                      Show images: <input type = "checkbox" name = "image" value = "Show"> 
			</div></p>
			
		</form>
		

   </div><!--sluttagg header-->
	<div id="content">

		<img id="background" src="background.jpg">
		<div class="opacitybox">

