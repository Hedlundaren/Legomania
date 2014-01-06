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
        <img id="headerpic" src="pictures/bakgrundopacityadv.png" alt ="Header picture">

		<!--Advance search--> 
        <form id ="wizardadv" name="wizard" action="advanced.php" method="get">
		
        <!--Länk till startsidan-->
		<a id="home" href="main.php">
		<img src="pictures/homebutton.png"> </a>

		<!--Forumlänk-->
		<a id="forum" href="http://www.sermon.se/legoforum">
		<img src="pictures/forumbutton12.png"></a>
                                                
        <p id="input">
			<input type ="text" name = "SetID" placeholder = "Enter SetID" size = "10"/>
			<input type ="text" name = "Year" placeholder = "Enter year" size = "10"/>
			<input type ="text" name = "Setname" placeholder = "Enter Setname" size = "10"/>
			<br>
			<input type ="text" name = "Categoryname" placeholder = "Enter Categoryname" size = "10"/>
			<input type ="text" name = "CatID" placeholder = "Enter CategoryID" size = "10"/>
			<input type ="text" name = "PartID" placeholder = "Enter PartID" size = "10"/>
			<br>
			

			<input type = "submit" value = "Find"/>
			<input type = "reset" value = "Clear"/>
			
			<img id="questionAdv" src="pictures/Questionmark_adv.png" alt="questionmark" 
			title="You can use advanced search to find sets according to more specific details by inputting multiple pieces of information. When searching for the setname or categoryname the search will display results that include your input, for the other attributes the search terms need to be exact."/>

		<div class="litentext">
			Show images: <input type = "checkbox" name = "image" value = "Show" checked> 
		</div></p>
		</form>
		
		
	</div><!--Sluttagg header-->
	<div id="content">
  <br>
		<img id="background" src="pictures/background.jpg">
		<div class="opacitybox">

        <?php
				//Öppna anslutning
                $connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
                        //Om databas lokalt nerladdad,
                        //$connection = mysql_connect ("localhost", "lego", "")
                or die ("Connection failed!");
                        
                mysql_select_db ("lego");
        ?>
