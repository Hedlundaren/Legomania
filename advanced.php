<?php

include "header advanced.php";

	//Fråga

	$connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
		or die ("Connection failed!");
	
	mysql_select_db ("lego");


if($_POST)
{
	$Setname = $_POST ["Setname"];
	$SetID = $_POST["SetID"];
	$Categoryname = $_POST["Categoryname"];
	$CatID = $_POST["CatID"];
	$Year = $_POST["Year"];
	$PartID = $_POST["PartID"];
	
		/* ---Förra------------------------------
        	$query = "(
                SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
                FROM sets
                WHERE sets.SetID = '$setID'
                        AND sets.Setname = '$setname'
                        AND sets.CatID = '$catID'
                        AND sets.Year = '$year'
                        AND categories.Categoryname = '$categoryname'
                        AND parts.PartID = '$partID')";
		   ---Förra------------------------------*/
		
		
	/* Idé: */
	$query = "(SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
        FROM sets ";
		//WHERE sets.SetID = '$setID'" tog ut
	
	//Frågan byggs på med varje if-sats
	//om first-funktion visar false, lägg till AND innan 'inte klart'
        
		/*----funktionstest----
		function extendQuery($x){
			if (!$x == ""){
				$query = $query . "AND sets.$x = '$x'";
			}
			elseif($x == ""){
				$query = $query . "AND sets.$x = '*'";
			}
		} */
		/*----från labb5----
		$query = "SELECT * FROM p WHERE 1";
		foreach ($_POST as $name => $value) {
			if($value!='')
				$query = $query . " AND " . $name . " = '" . $value . "'";  
}
		*/
		
		//SetId
		if ($SetID!=""){
			$query = $query . " WHERE sets.SetID = '" . $SetID . "'";
        }
		elseif($SetID == ""){
			$query = $query . " WHERE sets.SetID = * ";
		}
		
		//Setname
		if ($Setname!=""){
			$query = $query . " AND sets.Setname = '" . $Setname . "'";
        }
		elseif($Setname == ""){
			$query = $query . " AND sets.Setname = * ";
		}
        
		//Catogoryname
        if ($Categoryname!=""){
            $query = $query . " AND categories.Categoryname = '" . $Categoryname . "'";
        }
		elseif ($Categoryname == ""){
            $query = $query . " AND categories.Categoryname = * ";
        }
		
		//CatID
        if ($CatID!=""){
            $query = $query . " AND sets.CatID = '" . $CatID . "'";
        }
		elseif ($CatID == ""){
            $query = $query . " AND sets.CatID = * ";
        }
		
		//Year
        if ($Year!=""){
            $query = $query . " AND sets.Year = '" . $Year . "'";
        }
		elseif ($Year == ""){
            $query = $query . " AND sets.Year = * ";
        }
		
		//PartID
        if ($PartID!=""){
            $query = $query . " AND parts.PartID = '" . $PartID . "'";
        }
		elseif ($PartID == ""){
            $query = $query . " AND parts.PartID = *";
        }
		
	$query = $query . ')';
	
	print($query);    
	$contents = mysql_query($query) or trigger_error(mysql_error().$contents);

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
