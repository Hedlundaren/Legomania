<?php
include "header.php";

    //Fråga: w3c validering
        
if($_GET)
{
        $value = $_GET ["alternativ"];
        $search = $_GET["search"];

		/*---paging2---*/
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
		}
		else{
			$page=1;
		};
		$start_from = ($page-1) * 20; 
		
		//början query-stringen
		$queryStartNormal = "(SELECT sets.Setname, sets.SetID, sets.Year
                  FROM sets ";
				  
		$queryStartCount = "(SELECT COUNT(sets.Setname)
                  FROM sets ";
		
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

		//avslutan på query-stringen
		$queryNormal = $queryStartNormal . $query . " LIMIT $start_from, 20)";
		
        $contents = mysql_query("$queryNormal");
		
		//om inga resultat hittas
		//br-taggar temporär lösning
		if(mysql_num_rows($contents) == 0){
			echo("<table><td><h1>No results.</h1></td></table>");
		}
		else{
		
        print("<table border='border' cellpadding='6' cellspacing='3'>\n");
                print("<tr>");

                        for($i = 0; $i < mysql_num_fields($contents); $i++){
                                $fieldname = mysql_field_name($contents, $i);
                                print("<th>$fieldname</th>");
                        }
                        print("<th class='pictureColumn'>Image</th>");

                print("</tr>\n");

		//utskrift
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
			echo"<a href='search.php?page=".$i."&alternativ=".$value."&search=".$search."'>".$i."</a> ";
		}
		
		
		} //else-satsen
        
		mysql_close($connection);
}

include "footer.php";
