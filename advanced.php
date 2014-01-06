<?php

include "header advanced.php";

if($_GET)
{
	$Setname = $_GET ["Setname"];
	$SetID = $_GET["SetID"];
	$Categoryname = $_GET["Categoryname"];
	$CatID = $_GET["CatID"];
	$Year = $_GET["Year"];
	$PartID = $_GET["PartID"];


		//För pagineringen
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
		}
		else{
			$page=1;
		};
		$start_from = ($page-1) * 20; 
		
		//Början query-stringen
		$queryStartNormal = "(SELECT DISTINCT sets.Setname, sets.SetID, sets.Year
					FROM sets 
					WHERE 1 ";
				  
		$queryStartCount = "(SELECT DISTINCT COUNT(sets.Setname)
					FROM sets
					WHERE 1 ";		
		
		//Definiera som tom och bygg sedan på med de fält som fyllts i 
		$query = " ";
		
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

	//Sätt ihop och avsluta queryn
	$queryNormal = $queryStartNormal . $query . " LIMIT $start_from, 20)";
	
	$contents = mysql_query($queryNormal) or trigger_error(mysql_error().$contents);

	
	//Om inga resultat hittas
	if(mysql_num_rows($contents) == 0){
		echo("<table><td><h1>No results.</h1></td></table>");
	}
	
	//Annars så fortsätter sökningen och vi skriver ut resultatet
	else{

		print("<table border='border' cellpadding='6' cellspacing='3'>\n");
			//Skriv ut tabellhuvudet
			print("<tr>");

				for($i = 0; $i < mysql_num_fields($contents); $i++){
					$fieldname = mysql_field_name($contents, $i);
					print("<th>$fieldname</th>");
				}
				print("<th class='pictureColumn'>Image</th>");

			print("</tr>\n");
			
			//Skriv ut varje rad för sig. Länka till varje set
			while($row = mysql_fetch_row($contents)){
				print("<tr>");
					print("<td><a class='blockfun' href='setinfo.php?setID=$row[1]'>$row[0]</a></td>");
					
					for($i = 1;$i < mysql_num_fields($contents); $i++){
						print("<td>$row[$i]</td>");
					}
					
					//Inkludera bilderna
					include "searchfunctions/imagerow.php";	

				print("</tr>\n");
			}
		print("</table>\n");

		//Inkludera pagination för advance
		include "searchfunctions/pagenationAdv.php";
	}

}

include "footer.php";
