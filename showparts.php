<?php

//Hitta de delar vi vill visa
$query = "(
	SELECT DISTINCT parts.partname, parts.PartID, inventory.Quantity, colors.Colorname, colors.ColorID
	FROM parts, inventory, colors
	WHERE  inventory.SetID = '$setID'
		AND parts.PartID = inventory.ItemID
		AND colors.ColorID = inventory.ColorID)";

$contents = mysql_query("$query");

//Skriv ut resultatet
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
		
			//Skriv ut bild om det finns och länka, om möjligt, till en stor version
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

			//Skriv ut resten
			for($i = 0;$i < mysql_num_fields($contents) -1; $i++){
				print("<td>$row[$i]</td>");
			}

		print("</tr>\n");
	}

print("</table>\n");
