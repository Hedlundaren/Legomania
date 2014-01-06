<?php
include "header.php";
        
if($_GET)
{
        $value = $_GET ["alternativ"];
        $search = $_GET["search"];

		//För pagineringen
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
		}
		else{
			$page=1;
		};
		$start_from = ($page-1) * 20; 
		
		//Början query-strängen
		$queryStartNormal = "(SELECT sets.Setname, sets.SetID, sets.Year
                  FROM sets ";
				  
		$queryStartCount = "(SELECT COUNT(sets.Setname)
                  FROM sets ";
		
		//Mitten av query-strängen
        // Alternativ 1: Sök på SetID
        if ($value == "SetID"){
			$query = "WHERE sets.SetID LIKE '%$search%'";
        }
        
        // Alternativ 2: Sök på Categoryname
        if ($value == "Categoryname"){
			$query = "WHERE sets.CatID IN
                                        (SELECT categories.CatID
                                         FROM categories
                                         WHERE categories.Categoryname LIKE '%$search%')";
        }

        // Alternativ 3: Sök på Setname
        if ($value == "Setname"){
			$query = "WHERE sets.setname LIKE '%$search%'";
        }

        // Alternativ 4: Sök på SetYear
        if ($value == "Year"){
                $query = "WHERE sets.Year = '$search'";
        }

		//Avslutet på query-strängen
		$queryNormal = $queryStartNormal . $query . " LIMIT $start_from, 20)";
		
        $contents = mysql_query("$queryNormal");
		
		//Om inga resultat hittas
		if(mysql_num_rows($contents) == 0){
			echo("<table><td><h1>No results.</h1></td></table>");
		}
		//Annars så fortsätter sökningen och vi skriver ut resultatet
		else{
		
			//Skriv ut tabellhuvudet
			print("<table border='border' cellpadding='6' cellspacing='3'>\n");
					print("<tr>");

							for($i = 0; $i < mysql_num_fields($contents); $i++){
									$fieldname = mysql_field_name($contents, $i);
									print("<th>$fieldname</th>");
							}
							//En speciell utskrift för vår JS-funktion
							print("<th class='pictureColumn'>Image</th>");

					print("</tr>\n");

				//Skriv ut resultatet
				while($row = mysql_fetch_row($contents)){
						print("<tr>");
								//Gör en länk till specifikt set
								print("<td><a class='blockfun' href='setinfo.php?setID=$row[1]'>$row[0]</a></td>");
								
								for($i = 1;$i < mysql_num_fields($contents); $i++){
										print("<td>$row[$i]</td>");
								}

								//Inkludera bildraden					
								include "searchfunctions/imagerow.php";	

						print("</tr>\n");
				}
			print("</table>\n");
			
			//Inkludera paginationen
			include "searchfunctions/pagenation.php";
		
		}
}

include "footer.php";
