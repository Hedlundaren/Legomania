<?php print ("<!DOCTYPE html>");?>
<html>
<head>
<meta charset="utf-8">
<title>Legomania</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<header>

		<!--bakgrund i header-->
		<div id="fade">
		<img id="headerpic" src="bakgrundopacity.png"> 
		</div>

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

	<!--sökfält-->
			<br>
			<input type ="text" name ="search" placeholder = "Enter input!" />
			<br/>
			
			<!--knappar-->
			<input type = "submit" value = "Find"/>
			<input type = "reset" value = "Clear"/>
			
			<div class="litentext">Show images: <input type = "checkbox" name = "image" value = "Show">
			</div>

		</form>

		<!--Avancerad sök-->
		<div id="advanced">
		<a href = "advanced.php"> Advance search 
		</div>

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

	<!--Bakgrund i body-->
	<img id="background" src="bakgrund3.png">
	 <!--opacity för tabell-->
	<div class="opacitybox">

<?php
        $connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
                //Om databas lokalt nerladdad,
                        //$connection = mysql_connect ("localhost", "lego", "")
                or die ("Connection failed!");
        
        mysql_select_db ("lego");
?>

