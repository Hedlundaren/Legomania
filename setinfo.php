<?php
include "header.php";

$setID = $_GET["setID"];


$quest = "(
	SELECT DISTINCT sets.Setname, sets.Year, SUM(inventory.Quantity) AS total
	FROM sets, inventory
	WHERE  inventory.SetID = '$setID'
		AND sets.SetID = inventory.SetID
		GROUP BY inventory.SetID)";
		
$konsum = mysql_query("$quest");
$kolumn = mysql_fetch_row($konsum);

//Skriv ut namnet på valt set, år, antal delar samt beräknad tidsåtgång 
print ("<table><tr>");
print ("<td><h2>'$kolumn[0]'</h2></td>");
print ("<tr><td><h3>$kolumn[1]</h3></td></tr>");
$qvant = $kolumn[2]/2;
print ("<tr><td><h3>Estimated time required: $qvant min </h3></td></tr></tr><tr>");
//Visa en stor bild på valt set
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
			print ("<div  class='litentext' id='showparts'>Show parts: <input type = 'checkbox' name = 'parts' value = 'Show'></div>");	
//Välj ifall du ska visa delarna i valt set



// Visa alla delar i valt set 
$query = "(
	SELECT DISTINCT parts.partname, parts.PartID, inventory.Quantity, colors.Colorname, colors.ColorID
	FROM parts, inventory, colors
	WHERE  inventory.SetID = '$setID'
		AND parts.PartID = inventory.ItemID
		AND colors.ColorID = inventory.ColorID)";

$contents = mysql_query("$query");

print("<table id='setinfotable' class='parts' border='border' cellpadding='6' cellspacing='3'>\n");
	print("<tr>");
	print("<th class='pictureColumn'>Image</th>");

	for($i = 0; $i < mysql_num_fields($contents) - 1; $i++){
		$fieldname = mysql_field_name($contents, $i);
		print("<th>$fieldname</th>");
	}

	print("</tr>\n");

	while($row = mysql_fetch_row($contents)){
		print("<tr>");
		$img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
		$gif_url = $img_dir . 'P/' . $row[4] . '/' . $row[1] . '.gif'; 
		$jpg_url = $img_dir . 'P/' . $row[4] . '/' . $row[1] . '.jpg';
		
			$gifbig_url = $img_dir . 'PL/' . $row[1] . '.gif'; 
			$jpgbig_url = $img_dir . 'PL/' . $row[1] . '.jpg';

		if(@fclose(@fopen($gif_url, "r"))){
			if(@fclose(@fopen($gifbig_url, "r"))){
				print("<td class='pictureColumn'><a href='$gifbig_url'> 
				<img src='$gif_url' alt='gif-image' /></a></td>");
			}
			else if(@fclose(@fopen($jpgbig_url, "r"))){
				print("<td class='pictureColumn'><a href='$jpgbig_url'> 
				<img src='$gif_url' alt='gif-image' /></a></td>");
			}
			else{
				print("<td class='pictureColumn'><img src='$gif_url' alt='gif-image' /></td>");
			}
		}

		else if(@fclose(@fopen($jpg_url, "r"))){
			if(@fclose(@fopen($gifbig_url, "r"))){
				print("<td class='pictureColumn'><a href='$gifbig_url'> 
				<img src='$jpg_url' alt='jpg-image' /></a></td>");
			}
			else if(@fclose(@fopen($jpgbig_url, "r"))){
				print("<td class='pictureColumn'><a href='$jpgbig_url'> 
				<img src='$jpg_url' alt='jpg-image' /></a></td>");
			}
			else{
				print("<td class='pictureColumn'><img src='$jpg_url' alt='jpg-image' /></td>");
			}
		}

		else{
			print("<td class='pictureColumn'>" . "No Image" . "</td>");
		}

		for($i = 0;$i < mysql_num_fields($contents) -1; $i++){
			print("<td>$row[$i]</td>");
		}

		print("</tr>\n");
	}

print("</table>\n");

mysql_close($connection);

include "footer.php";
