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
                <img id="headerpic" src="pictures/bakgrundopacity.png" alt="Header picture.">
                

                <!--innehåller alla element i header-->
                <form id ="wizard" name="wizard" action="search.php" method="get" onsubmit="return validate()">
                        <!--länk till startsidan-->
                        <a id="home" href="main.php">
                        <img src="pictures/homebutton.png" alt="Home button"> </a>

                        <!--Forumlänk-->
                        <a id="forum" href="http://www.sermon.se/legoforum">
                        <img src="pictures/forumbutton12.png" alt="Forum button"></a>
                        <div class="litentext" >Search sets by: &nbsp;</div>
								<label>
                                        <!--en lista med alternativen för vad man ska söka-->
                                            <select name="alternativ">
                                                <option value="SetID">SetID</option>
                                                <option value="Setname">Setname</option>
                                                <option value="Year">Year</option>
                                                <option value="Categoryname">Categoryname</option>
                                            </select>
                                </label>
                        <!--Inforuta om hur man söker-->        
                        <img id="question" src = "pictures/Questionmark3.png" alt="Questionmark" 
						title = "Select attribute to search sets by. SetID, Setname and Categoryname will display any results which include you input. For 'year' the input will need to be exact."/>

                        <!--sökfält-->
                        <br>
							<input type ="text" name ="search" placeholder = "Enter input!" />
                        <br/>
                        
                        
                        <!--knappar-->
                        <input type = "submit" value = "Find"/>
                        <input type = "reset" value = "Clear"/>
                        
						<!--JS-funktion-->
                        <div class="litentext">
							Show images:
							<input type = "checkbox" name = "image" value = "Show" checked>
							
							<!--Avancerad sök-->                     
							<a id ="advanced" href = "advanced.php" >
							&nbsp;&nbsp;&nbsp; Advanced search
							</a>                       
                        </div>                                             
                
                </form>

                

        </div><!--sluttagg header-->
        <div id="content">
        
        <!--Bakgrund i body-->
        <img id="background" src="pictures/bakgrund3.png" alt="Background">
		
        <!--Validera sökningen-->
        <script>
        function validate(){
        var form = document.forms["wizard"]["search"].value;

        if (form == "Enter input!" || form == "Null" || form == ""){
                window.alert("Please enter input!");
                return false;
        }
                return true;
        }
        </script>
		
         <!--Opacity för tabell-->
        <div class="opacitybox">

        <?php
				//Öppna anslutning
                $connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
                        //Om databas lokalt nerladdad,
                        //$connection = mysql_connect ("localhost", "lego", "")
                or die ("Connection failed!");
                        
                mysql_select_db ("lego");
        ?>
