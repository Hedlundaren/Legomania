<?php

include "header2.php";

	//Fråga

	$connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
		or die ("Connection failed!");
	
	mysql_select_db ("lego");


if($_POST)
{
	$setname = $_POST ["setname"];
	$setID = $_POST["setID"];
	$categoryname = $_POST["categoryname"];
	$catID = $_POST["catID"];
	$year = $_POST["year"];
	$partID = $_POST["partID"];
		/* ---Går inte------------------------------
        	$query = "(
                SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
                FROM sets
                WHERE sets.SetID = '$setID'
                        AND sets.Setname = '$setname'
                        AND sets.CatID = '$catID'
                        AND sets.Year = '$year'
                        AND categories.Categoryname = '$categoryname'
                        AND parts.PartID = '$partID')";
		   ---Går inte------------------------------*/
		
		
	/*
	Idé:
	$query = "(
        SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
        FROM sets
        WHERE sets.SetID = '$setID'
	*/
	//Frågan byggs på med varje if-sats
	//if first-funktion visar false, lägg till AND innan
        if ($setname == ""){
        	//$query = $query . 'AND sets.Setname = "*"'
				$setname = "*";
        }
        
        if ($setID == ""){
                $setID = "*";
        }
        if ($categoryname == ""){
                $categoryname = "*";
        }
        if ($catID == ""){
                $catID = "*";
        }
        if ($year == ""){
                $year = "*";
        }
        if ($partID == ""){
                $partID = "*";
        }
        

        
	$contents = mysql_query("$query");

//Utskrift
	print("<table border='border' cellpadding='6' cellspacing='3'>\n");
		print("<tr>");

			for($i = 0; $i < mysql_num_fields($contents); $i++){
				$fieldname = mysql_field_name($contents, $i);
				print("<th>$fieldname</th>");
			}
			print("<th class='pictureColumn'>Image</th>");

		print("</tr>\n");

	while($row = mysql_fetch_row($contents)){
		print("<tr>");
			print("<td><a href='suppliers.php?setID=$row[1]'>$row[0]</a></td>");
			
			for($i = 1;$i < mysql_num_fields($contents); $i++){
				print("<td>$row[$i]</td>");
			}

			$img_dir = "http://webstaff.itn.liu.se/~stegu76/img.bricklink.com/";
			$gif_url = $img_dir . 'S/' . $row[1] . '.gif'; 
			$jpg_url = $img_dir . 'S/' . $row[1] . '.jpg';
			
				$gifbig_url = $img_dir . 'SL/' . $row[1] . '.gif'; 
				$jpgbig_url = $img_dir . 'SL/' . $row[1] . '.jpg';

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
				print("<td class='pictureColumn'>" . "bild saknas" . "</td>");
			}


		print("</tr>\n");
	}
	print("</table>\n");

	mysql_close($connection);
}

include "footer.php";
