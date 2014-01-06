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
                <img id="headerpic" src="bakgrundopacity.png">
                

                <!--innehåller alla element i header-->
                <form id ="wizard" name="wizard" action="search.php" method="get" onsubmit="return validate()">
                        <!--länk till startsidan-->
                        <a id="home" href="https://www.facebook.com/">
                        <img src="homebutton.png"> </a>

                        <!--Forumlänk-->
                        <a id="forum" href="http://www.sermon.se/legoforum">
                        <img src="forumbutton12.png"></a>

                                <label>
                                        <div class="litentext">Search sets by: &nbsp;
                                        </div>
                                        <!--en lista med alternativen för vad man ska söka-->
                                                <select name="alternativ">
                                                        <option value="SetID">SetID</option>
                                                        <option value="Setname">Setname</option>
                                                        <option value="Year">Year</option>
                                                        <option value="Categoryname">Categoryname</option>
                                                </select>
                                </label>
                                
                                                <img id="question" src = "Questionmark.jpg" alt="Questionmark" title = "Select what you want to search sets by. SetID, Setname and Categoryname will show everything that have your input in it. Year will only show the correct input"/>

                        <!--sökfält-->
                        <br>
                        <input type ="text" name ="search" placeholder = "Enter input!" />
                        <br/>
                        
                        
                        <!--knappar-->
                        <input type = "submit" value = "Find"/>
                        <input type = "reset" value = "Clear"/>
                        
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
        <img id="background" src="bakgrund3.png">
		
        <!-- Fråga hur man bäst validerar, och hur man gör för att det inte ska gå vidare! -->
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

         <!--opacity för tabell-->
        <div class="opacitybox">

        <?php
                $connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
                        //Om databas lokalt nerladdad,
                        //$connection = mysql_connect ("localhost", "lego", "")
                or die ("Connection failed!");
                        
                mysql_select_db ("lego");
        ?>
