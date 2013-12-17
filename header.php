<?php print ("<!DOCTYPE html>");?>
<html>
<head>
        <meta charset="utf-8">
        <title>Legomania</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<!--en lista med alternativen för vad man ska söka-->
<header>

<div id="fade">
<img src="bakgrundopacity.png">
</div>

<a id="home" href="https://www.facebook.com/">
<img src="homebutton.png"> </a>

<a id="forum" href="http://www.youtube.com/watch?v=uOj5CX6X4Gs"><img src="forumbutton12.png"></a>

<form id ="wizard" name="wizard" action="search.php" method="post" onsubmit="return validate()">
        <p id="input"><label>
        Search sets by: &nbsp;
        <br>
        <select name="alternativ">
                <option value="SetID">SetID</option>
                <option value="Setname">Setname</option>
                <option value="Year">Year</option>
                <option value="Categoryname">Categoryname</option>
                </select>
                </label></p>

<!--sökfält-->
        <p id="input2">
        <input type ="text" name ="search" placeholder = "Enter input!" size ="20"/>
        <br/>
        <input type = "submit" value = "Find"/>
        <input type = "reset" value = "Clear"/>
        Show images: <input type = "checkbox" name = "image" value = "Show">
        </p>
</form>

<p><a href = "advance.php"> Advance search </a></p>
<!--
<div id="forum">
<a href="http://facebook.com/">Forum</a>
</div>
-->
</header>

<!-- Fråga hur man bäst validerar, och hur man gör för att det inte ska gå vidare! -->
<script>
function validate(){
var form = document.forms["wizard"]["search"].value;

if (form == "Enter input!" || form == "Null" || form == "")
{
window.alert("Please enter input!");
return false;
}
return true;
}
</script>

<img id="background" src="bakgrund3.png">
<div class="opacitybox">

<?php
        $connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
                //Om databas lokalt nerladdad,
                        //$connection = mysql_connect ("localhost", "lego", "")
                or die ("Connection failed!");
        
        mysql_select_db ("lego");
?>
