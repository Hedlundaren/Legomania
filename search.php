<?php
include "header.php";

    //Fråga: w3c validering
        
if($_POST)
{
        $value = $_POST ["alternativ"];
        $search = $_POST["search"];

		/*---paging2---*/
		if (isset($_GET["page"])){
			$page  = $_GET["page"];
		}
		else{
			$page=1;
		};
		$start_from = ($page-1) * 20; 
		
		//början query-stringen
		$query = "(SELECT sets.Setname, sets.SetID, sets.Year
                  FROM sets ";
		
        // Alternativ 1: Sök på SetID
        if ($value == "SetID"){
			$query = $query . "WHERE sets.SetID LIKE '%$search%'";
        }
        
        // Alternativ 2: Sök på Categoryname
        if ($value == "Categoryname"){
			$query = $query . "WHERE sets.CatID IN
                                        (SELECT categories.CatID
                                         FROM categories
                                         WHERE categories.Categoryname LIKE '%$search%')";
        }

        // Alternativ 3: Sök på Setname
        if ($value == "Setname"){
			$query = $query . "WHERE sets.setname LIKE '%$search%'";
        }

        // Alternativ 4: Sök på SetYear
        if ($value == "Year"){
                $query = $query . "WHERE sets.Year = '$search'";
        }

		//avslutan på query-stringen
		$query = $query . " LIMIT $start_from, 20)";
		
        $contents = mysql_query("$query");
		
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
		//början query-stringen
		$query = "(SELECT COUNT(sets.Setname), sets.SetID, sets.Year
                  FROM sets ";
		
        // Alternativ 1: Sök på SetID
        if ($value == "SetID"){
			$query = $query . "WHERE sets.SetID LIKE '%$search%')";
        }
        
        // Alternativ 2: Sök på Categoryname
        if ($value == "Categoryname"){
			$query = $query . "WHERE sets.CatID IN
                                        (SELECT categories.CatID
                                         FROM categories
                                         WHERE categories.Categoryname LIKE '%$search%'))";
        }

        // Alternativ 3: Sök på Setname
        if ($value == "Setname"){
			$query = $query . "WHERE sets.setname LIKE '%$search%')";
        }

        // Alternativ 4: Sök på SetYear
        if ($value == "Year"){
                $query = $query . "WHERE sets.Year = '$search')";
        }
		
		//$nySQL = "(SELECT COUNT(sets.Setname) FROM sets)";
		$rs_result = mysql_query($query);
		$row = mysql_fetch_row($rs_result);
		$total_records = $row[0];
		$total_pages = ceil($total_records/20);

		for ($i = 1; $i <= $total_pages; $i++) {
			echo"<a href='search.php?page=".$i."'>".$i."</a> ";
		}
		
		/**paging**********
		echo("<p>");
        echo("Pages: ");
        $NumberOfPages = ceil((mysql_num_rows($contents))/20);
        for($i =0; $i < $NumberOfPages; $i++)
        {
                //print a number with a link to the javascript function that creates the paging
                echo("<a onclick='javascript:scrollResult($i);' href='#result'>" . ($i+1) . " &nbsp;</a>");
        }
        echo("</p>");
		**paging***********/
		
		} //else-satsen
        
		mysql_close($connection);
}

include "footer.php";
