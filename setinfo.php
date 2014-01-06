<?php
include "header.php";

$setID = $_GET["setID"];

//Räkna ut hur många bitar setet har samt ta fram namn och år
$quest = "(
	SELECT DISTINCT sets.Setname, sets.Year, SUM(inventory.Quantity) AS total
	FROM sets, inventory
	WHERE  inventory.SetID = '$setID'
		AND sets.SetID = inventory.SetID
		GROUP BY inventory.SetID)";
		
$konsum = mysql_query("$quest");
$kolumn = mysql_fetch_row($konsum);

//Skriv ut namnet på valt set, år, antal delar samt beräknad tidsåtgång; antal bitar/2
print ("<table><tr>");
	print ("<td><h2>'$kolumn[0]'</h2></td>");
	print ("<tr><td><h3>$kolumn[1]</h3></td></tr>");
	$qvant = $kolumn[2]/2;
	print ("<tr><td><h3>Estimated time required: $qvant min </h3></td></tr></tr><tr>");

//Visa, om möjligt, en stor bild på valt set
		$img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
		$gif_url = $img_dir . 'SL/' . $setID . '.gif';
		$jpg_url = $img_dir . 'SL/' . $setID . '.jpg';

		if(@fclose(@fopen($gif_url, "r"))){
			print("<td><img src='$gif_url' alt='gif-image' /></td>");
		}
		
		else if(@fclose(@fopen($jpg_url, "r"))){
			print("<td><img src='$jpg_url' alt='jpg-image' /></td>");
		}
		
		else{
			print("<td>" . "No Image" . "</td>");
		}

print ("</tr></table>");

//Välj ifall du vill se delarna i valt set
print ("<div  class='litentext' id='showparts'>Show parts: <input type = 'checkbox' name = 'parts' value = 'Show'></div>");	

// Visa alla delar i valt set 
include "searchfunctions/showparts.php";

include "footer.php";
