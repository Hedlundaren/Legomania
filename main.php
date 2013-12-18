<?php
include "header.php";


	//Fråga -- set of the day, slumpat SetID förnyad med datum
	//exempel github @tistatos
$query = ("
	SELECT sets.SetID
	FROM sets
	WHERE sets.SetID = inventory.SetID
		AND images.ItemID = inventory.ItemID
		AND images.haslargejpg = '1'
		OR images.haslargegif = '1'
	ORDER BY RAND ()
	LIMIT 1");


$contents = mysql_query("$query");
//$row = mysql_fetch_field($contents);
/*
if (numOfResults($contents) == 0){
	echo("<h1>No results.</h1>");
}
else{
*/
	while($row = mysql_fetch_row($contents)){			
			for($i = 0;$i < mysql_num_fields($contents); $i++){
				print("<p>$row[$i]</p>");


print ("<table><tr>");
		$img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
		$gif_url = $img_dir . 'SL/' . $row[i] . '.gif';
		$jpg_url = $img_dir . 'SL/' . $row[i] . '.jpg';

		if(@fclose(@fopen($gif_url, "r"))){
		print("<td><a href='$gif_url'> <img src='$gif_url' alt='gif-image' /></a></td>");
		}
			
		else if(@fclose(@fopen($jpg_url, "r"))){
			print("<td><a href='$jpg_url'><img src='$jpg_url' alt='jpg-image' /></a></td>");
		}
			
		else{
			print("<td>" . "bild saknas" . "</td>");
		}
print ("</tr></table>");

			}
	}
	
//} till else-satsen där uppe
include "footer.php";
