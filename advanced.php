<?php

include "header advanced.php";

	//Fråga

	$connection = mysql_connect ("mysql.itn.liu.se", "lego", "")
		or die ("Connection failed!");
	
	mysql_select_db ("lego");


if($_GET)
{
	$Setname = $_GET ["Setname"];
	$SetID = $_GET["SetID"];
	$Categoryname = $_GET["Categoryname"];
	$CatID = $_GET["CatID"];
	$Year = $_GET["Year"];
	$PartID = $_GET["PartID"];


			/*---paging2---*/
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
		}
		else{
			$page=1;
		};
		$start_from = ($page-1) * 20; 
		
		//början query-stringen
		$queryStartNormal = "(SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
					FROM sets 
					WHERE 1 ";
				  
		$queryStartCount = "(SELECT DISTINCT COUNT(sets.Setname)
					FROM sets
					WHERE 1 ";		
					
		$query = " ";
		
	/* Idé: 
	$query = "(SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
        FROM sets 
		WHERE 1 ";*/
		
		//SetId
		if ($SetID!=""){
			$query = $query . "AND sets.SetID = '" . $SetID . "'";
        }


		//Setname
		if ($Setname!=""){
			$query = $query . " AND sets.Setname LIKE '%" . $Setname . "%'";
        }

        
		//Catogoryname
        if ($Categoryname!=""){
            $query = $query . " AND sets.CatID IN
                                        (SELECT categories.CatID
                                         FROM categories
                                         WHERE categories.Categoryname LIKE '%" . $Categoryname . "%')";
										 

        }

		
		//CatID
        if ($CatID!=""){
            $query = $query . " AND sets.CatID = '" . $CatID . "'";
        }

		
		//Year
        if ($Year!=""){
            $query = $query . " AND sets.Year = '" . $Year . "'";
        }

	
		//PartID
        if ($PartID!=""){
            $query = $query . " AND sets.SetID IN 
										(SELECT inventory.SetID
                                         FROM inventory
                                         WHERE inventory.ItemID = '" . $PartID . "')";
        }

		
	$queryNormal = $queryStartNormal . $query . " LIMIT $start_from, 20)";
	
	print($queryNormal);
	
	$contents = mysql_query($queryNormal) or trigger_error(mysql_error().$contents);

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
			print("<td><a href='setinfo.php?setID=$row[1]'>$row[0]</a></td>");
			
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

			/***paging2***/
		//Räkna resultat
		$queryCount = $queryStartCount . $query . ')';
		
		$rs_result = mysql_query($queryCount);
		$row = mysql_fetch_row($rs_result);
		$total_records = $row[0];
		$total_pages = ceil($total_records/20);

		for ($i = 1; $i <= $total_pages; $i++) {
			echo"<a href='advanced.php?page=".$i."&SetID=".$SetID."&Year=".$Year."&Setname=".$Setname."&Categoryname=".$Categoryname."&CatID=".$CatID."&PartID=".$PartID."'>".$i."</a> ";
		}

	
	mysql_close($connection);
}

include "footer.php";
